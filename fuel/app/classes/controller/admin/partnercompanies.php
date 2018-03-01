<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Admin PartnerCompanies Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */

use JpPrefecture\JpPrefecture;

class Controller_Admin_PartnerCompanies extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $this->template->title = '会社一覧';
        $this->template->content = View::forge('admin/partnercompanies/index', [
            'companies' => \Model_Partner_Company::find('all', ['order_by' => ['id' => 'desc']]),
        ]);
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_create()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/partnercompanies/create', [
            'val' => \Model_Partner_Company::validate(),
            'partner_company' => new \Model_Partner_Company(),
            'company_image_err' => false,
            'company_logo_err' => false,
        ]);
    }

    /**
     * Store
     *
     * @access  public
     * @return  Response
     */
    public function action_store()
    {
        $val = \Model_Partner_Company::validate();

        $company_image_err = false;
        $company_logo_err = false;

        if ($company_image = \Upload::get_errors('company_image'))
        {
            $image_error = reset($company_image['errors']);
            
            if ($image_error['error'] != \Upload::UPLOAD_ERR_NO_FILE)
            {
                $company_image_err = $image_error['message'];
            }
        }

        if ($company_logo = \Upload::get_errors('company_logo'))
        {
            $logo_error = reset($company_logo['errors']);
            
            if ($logo_error['error'] != \Upload::UPLOAD_ERR_NO_FILE)
            {
                $company_logo_err = $logo_error['message'];
            }
        }

        if ($val->run())
        {
            $password = \Str::random('hexdec', 16);
            $auth = Eauth::instance('partner');

            \DB::start_transaction();
            try
            {
                $user_id = $auth->create_user($val->validated('partner_company.email'), $password, 2, $same_email = true);

                if (!$user_id)
                    throw new Exception('Could not create user');

                $partner_company = \Model_Partner_Company::find($user_id);
                $partner_company->set($val->validated('partner_company'));
                $company = new \Model_Company($val->validated('company'));

                if ($val->validated('company_features'))
                {
                    $company->features = \Model_Company_Feature::find('all', [
                        'where' => [
                            ['id', 'IN', $val->validated('company_features')]
                        ]
                    ]);
                }

                $company->geocodes[] = new \Model_Company_Geocode([
                    'company_office_id' => null,
                    'address' => JpPrefecture::findByCode($company->prefecture_code)->nameKanji." ".$company->address,
                    'lat' => 0,
                    'lng' => 0,
                ]);

                if (!$company->display_name)
                    $company->display_name = $partner_company->company_name;

                $partner_company->company = $company;

                if ($partner_company->save())
                {
                    $company = $partner_company->company;
                    
                    foreach(Upload::get_files() as $key => $file)
                    {
                        $file_name = \Str::random('alpha', 16).'.'.$file['extension'];
                        \Upload::save($key);

                        if ($file['field'] == 'company_image')
                        {
                            $company->lpgas_company_image = $file_name;
                            $tmp_file = Upload::get_files('company_image')['saved_as'];
                            $url = \Helper\S3::makeImageUrl($company, false);
                        }
                        
                        if ($file['field'] == 'company_logo')
                        {
                            $company->lpgas_company_logo = $file_name;
                            $tmp_file = Upload::get_files('company_logo')['saved_as'];
                            $url = \Helper\S3::makeImageUrl($company, true);
                        }
                        
                        \Helper\S3::put_image(APPPATH . 'tmp/'.$tmp_file, $url, $file['type']);
                        \File::delete(APPPATH . 'tmp/'.$tmp_file);
                    }

                    $company->save();

                    \Helper\Notifier::notifyCompanyPassword($partner_company, $password);

                    \DB::commit_transaction();
                    Session::set_flash('success', 'partner_companyを追加しました');
                }

                Response::redirect('admin/partner_companies');
            }
            catch (\Exception $e)
            {
                \DB::rollback_transaction();
                \Log::error($e);
            }
        }

        Session::set_flash('error', 'partner_companyを追加できませんでした');

        $this->template->title = 'New partner_company';
        $this->template->content = View::forge('admin/partnercompanies/create', [
            'partner_company' => new \Model_Partner_Company(),
            'val' => $val,
            'company_image_err' => $company_image_err,
            'company_logo_err' => $company_logo_err,
        ]);
    }

    /**
     * Edit
     *
     * @access  public
     * @return  Response
     */
    public function action_edit($id)
    {
        if (!$partner_company = \Model_Partner_Company::find($id))
            throw new HttpNotFoundException;

        $this->template->title = 'Edit partner_company';
        $this->template->content = View::forge('admin/partnercompanies/edit', [
            'val' => \Model_Partner_Company::validate(),
            'partner_company' => $partner_company,
            'company_image_err' => false,
            'company_logo_err' => false,
        ]);
    }

    /**
     * Update
     *
     * @access  public
     * @return  Response
     */
    public function action_update($id)
    {
        if (!$partner_company = \Model_Partner_Company::find($id))
            throw new HttpNotFoundException;

        $val = \Model_Partner_Company::validate();
        $company_image_err = false;
        $company_logo_err = false;

        if ($company_image = \Upload::get_errors('company_image'))
        {
            $image_error = reset($company_image['errors']);
            
            if ($image_error['error'] != \Upload::UPLOAD_ERR_NO_FILE)
            {
                $company_image_err = $image_error['message'];
            }
        }

        if ($company_logo = \Upload::get_errors('company_logo'))
        {
            $logo_error = reset($company_logo['errors']);
            
            if ($logo_error['error'] != \Upload::UPLOAD_ERR_NO_FILE)
            {
                $company_logo_err = $logo_error['message'];
            }
        }

        if (!$company_image_err && !$company_logo_err && $val->run())
        {
            \DB::start_transaction();
            try
            {
                $partner_company->set($val->validated('partner_company'));

                $company = $partner_company->company;
                $company->set($val->validated('company'));

                foreach(Upload::get_files() as $key => $file)
                {
                    $file_name = \Str::random('alpha', 16).'.'.$file['extension'];
                    \Upload::save($key);

                    if ($file['field'] == 'company_image')
                    {
                        $company->lpgas_company_image = $file_name;
                        $tmp_file = Upload::get_files('company_image')['saved_as'];
                        $url = \Helper\S3::makeImageUrl($company, false);
                    }
                    
                    if ($file['field'] == 'company_logo')
                    {
                        $company->lpgas_company_logo = $file_name;
                        $tmp_file = Upload::get_files('company_logo')['saved_as'];
                        $url = \Helper\S3::makeImageUrl($company, true);
                    }
                    
                    \Helper\S3::put_image(APPPATH . 'tmp/'.$tmp_file, $url, $file['type']);
                    \File::delete(APPPATH . 'tmp/'.$tmp_file);
                }

                if (!$val->validated('company_features'))
                {
                    $company->features = [];
                }
                elseif (\Arr::pluck($company->features, 'id') != $val->validated('company_features'))
                {
                    $company->features = \Model_Company_Feature::find('all', [
                        'where' => [
                            ['id', 'IN', $val->validated('company_features')]
                        ]
                    ]);
                }

                if (!$company->display_name)
                    $company->display_name = $partner_company->company_name;

                $partner_company->company = $company;

                if ($partner_company->save())
                {
                    \DB::commit_transaction();
                    Session::set_flash('success', 'partner_companyを更新しました');
                }

                Response::redirect('admin/partner_companies');
            }
            catch (\Exception $e)
            {
                throw $e;
                
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        Session::set_flash('error', 'partner_companyを更新できませんでした');

        $this->template->title = 'Edit partner_company';
        $this->template->content = View::forge('admin/partnercompanies/edit', [
            'val' => $val,
            'partner_company' => $partner_company,
            'company_image_err' => $company_image_err,
            'company_logo_err' => $company_logo_err,
        ]);
    }

    /**
     * Show list of emails
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_index($id)
    {
        if (!$partner_company = \Model_Partner_Company::find($id))
            throw new HttpNotFoundException;

        $this->template->title = 'List of emails';
        $this->template->content = View::forge('admin/partnercompanies/emails_index', [
            'val' => \Model_Partner_Email::validate(),
            'partner_company' => $partner_company,
        ]);
    }

    /**
     * Store email
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_store($id)
    {
        if (!$partner_company = \Model_Partner_Company::find($id))
            throw new HttpNotFoundException;

        $val = \Model_Partner_Email::validate();

        if ($val->run())
        {
            $partner_company->emails[] = new \Model_Partner_Email($val->validated());

            if ($partner_company->save())
                Session::set_flash('success', 'emailを更新しました');

            Response::redirect("admin/partner_companies/{$id}/emails");
        }

        Session::set_flash('error', 'emailを更新できませんでした');

        $this->template->title = 'List of emails';
        $this->template->content = View::forge('admin/partnercompanies/emails_index', [
            'val' => $val,
            'partner_company' => $partner_company,
        ]);
    }

    /**
     * Delete email
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_destroy($id, $email_id)
    {
        if (!\Model_Partner_Company::find($id))
            throw new HttpNotFoundException;
        if (!$email = \Model_Partner_Email::find($email_id))
            throw new HttpNotFoundException;

        if ($email->delete()){
            Session::set_flash('success', 'emailを削除しました');
        }

        Response::redirect("admin/partner_companies/{$id}/emails");
    }
}
