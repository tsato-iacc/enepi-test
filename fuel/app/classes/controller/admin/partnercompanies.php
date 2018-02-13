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
            'companies' => \Model_Partner_Company::find('all'),
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
        $partner_company = new \Model_Partner_Company();

        $val = \Model_Partner_Company::validate($partner_company);

        if ($val->run())
        {
            \DB::start_transaction();
            try
            {
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

                if (!$company->display_name)
                    $company->display_name = $partner_company->company_name;

                $partner_company->company = $company;

                if ($partner_company->save())
                {
                    \DB::commit_transaction();
                    Session::set_flash('success', 'partner_companyを追加しました');
                }

                Response::redirect('admin/partner_companies');
            }
            catch (\Exception $e)
            {
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        Session::set_flash('error', 'partner_companyを追加できませんでした');

        $this->template->title = 'New partner_company';
        $this->template->content = View::forge('admin/partnercompanies/create', [
            'partner_company' => $partner_company,
            'val' => $val,
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

        $val = \Model_Partner_Company::validate($partner_company);

        if ($val->run())
        {
            \DB::start_transaction();
            try
            {
                $partner_company->set($val->validated('partner_company'));

                $company = $partner_company->company;
                $company->set($val->validated('company'));


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
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        Session::set_flash('error', 'partner_companyを更新できませんでした');

        $this->template->title = 'Edit partner_company';
        $this->template->content = View::forge('admin/partnercompanies/edit', [
            'val' => $val,
            'partner_company' => $partner_company,
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
