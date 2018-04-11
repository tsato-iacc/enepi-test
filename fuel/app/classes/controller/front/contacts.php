<?php

use JpPrefecture\JpPrefecture;
use \Helper\Tracking;
use Cms\Client;
use Cms\Exceptions\ClientException;

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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Contacts extends Controller_Front
{
    private $no_breadcrumb = true;
    private $no_drawer_menu = true;

    /**
     * Show
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        if ($this->param('media') == 'enechange')
        {
            $this->template = \View::forge('front/template_old');
            $this->template->title = 'お見積もり情報入力';
            $this->template->content = View::forge('front/contacts/old', [
                'val' => \Model_Contact::validate('old_form'),
                'contact' => new \Model_Contact(),
                'apartment_form' => \Input::get('apartment_form') ? true : false,
            ]);
        }
        else
        {
            $contact_id = \Input::get('contact_id');
            $token = \Input::get('token');

            if ($contact_id && $token)
            {
                $contact = \Model_Contact::find($contact_id);

                if (!$contact || $contact->token != $token)
                    throw new HttpNotFoundException();
            }
            else
            {
                $contact = new \Model_Contact();
            }

            $this->template = \View::forge('front/template');
            $this->template->title = 'プロパンガス(LPガス)料金を今より安く！無料比較サービス';
            $this->template->content = View::forge('front/contacts/index', [
                'contact' => $contact,
                'month_selected' => $contact->gas_meter_checked_month ? \Config::get('enepi.simulation.month.key_numeric.'.$contact->gas_meter_checked_month) : '',
                'slots' => \Model_Slot::getSlots(),
            ]);
        }
    }

    /**
     * Store
     *
     * @access  public
     * @return  Response
     */
    public function action_store()
    {
        // FIX ME
        // IMPORTANT USE CSRF PROTECTION
        $contact = new \Model_Contact();

        if (\Input::post('pr'))
        {
            if ($tracking = \Model_Tracking::find('first', ['where' => [['name', \Input::post('pr')]]]))
            {
                $contact->pr_tracking_parameter_id = $tracking->id;
            }
        }
        else
        {
            $contact->pr_tracking_parameter_id = $this->pr_tracking_id;
        }

        $contact->from_kakaku = $this->from_kakaku;
        $contact->from_enechange = $this->from_enechange;
        $contact->terminal = \Config::get('enepi.terminal_types.'.$this->terminal_type);

        $contact_id = \Input::post('contact_id');
        $token = \Input::post('token');

        if ($contact_id && $token)
        {
            $original = \Model_Contact::find($contact_id);

            if ($original && $original->token == $token)
            {
                $contact->original_contact_id = $original->id;
            }
        }

        $validation_factory = 'new_contract';

        // Is it the new form
        if (\Input::post('new_form'))
        {
            if (\Input::post('lpgas_contact.house_kind') == 'apartment')
            {
                $validation_factory = 'apartment';
                $contact->apartment_owner = true;
            }
            elseif (\Input::post('lpgas_contact.estimate_kind') == 'change_contract')
            {
                $validation_factory = 'change_contract';
            }
        }
        else
        {
            // Old form or API request
            $validation_factory = 'old_form';

            if (\Input::post('lpgas_contact.ownership_kind') == 'owner')
            {
                $contact->house_kind = \Config::get('models.contact.house_kind.detached');
            }
            elseif (\Input::post('lpgas_contact.ownership_kind') == 'borrower' || \Input::post('lpgas_contact.ownership_kind') == 'unit_owner')
            {
                $contact->house_kind = \Config::get('models.contact.house_kind.store_ex');
            }
        }

        $val = \Model_Contact::validate($validation_factory);

        if ($val->run())
        {
            $contact->set($val->validated('lpgas_contact', 'contact'));

            // Calculate gas usage by house hold
            if (!$contact->gas_used_amount && $contact->house_hold)
                $this->calculateGasUsage($contact);

            if ($contact->house_hold)
                $contact->body = "「世帯人数：{$contact->house_hold}　シミュレーションにより使用量：{$contact->gas_used_amount}m3で推定入力」";

            \DB::start_transaction();
            try
            {
                $contact->save();
                \DB::commit_transaction();

                $notice_param = \Crypt::encode(\Format::forge(['id' => $contact->id, 'token' => $contact->token, 'pin' => $contact->pin])->to_json());
                // Set cookie to 3 month
                \Cookie::set('notice_param', $notice_param, 60 * 60 * 24 * 90);

                $query = [
                    'conversion_id' => "LPGAS-{$contact->id}",
                ];

                if ($contact->sent_auto_estimate_req)
                {
                    $query['token'] = $contact->token;

                    return \Response::redirect("lpgas/contacts/{$contact->id}?".http_build_query($query));
                }
                else
                {
                    if ($this->from_kakaku)
                    {
                        return \Response::redirect('kakaku/lpgas/contacts/done?'.http_build_query($query));
                    }
                    else
                    {
                        return \Response::redirect('lpgas_contacts/done?'.http_build_query($query));
                    }
                }
            }
            catch (\Exception $e)
            {
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス会社を簡単ネット見積もり'],
            ['name' => 'keywords', 'content' => 'プロパンガス,見積もり'],
        ];

        // Old form or API request
        if ($validation_factory == 'old_form')
        {
            $this->template = \View::forge('front/template_old');

            $view = \View::forge('front/contacts/old', [
                'contact' => $contact,
                'val' => $val,
                'apartment_form' => \Input::post('apartment_form') ? true : false,
            ]);
        }
        else
        {
            $view = \View::forge('front/contacts/index', [
                'contact' => $contact,
                'val' => $val,
                'month_selected' => '',
            ]);
        }

        $this->template->title = 'お見積もり情報入力';
        $this->template->meta = $meta;
        $this->template->header = View::forge('front/contacts/lpgas_contacts_header');
        $this->template->content = $view;
        $this->template->footer = View::forge('front/contacts/lpgas_contacts_footer');
        $this->template->css_call = 'done';
    }

    /**
     * Old estimate form
     *
     * @access  public
     * @return  Response
     */
    public function get_old()
    {
        $contact = new \Model_Contact();

        if ($estimate_kind = \Input::get('estimate_kind'))
        {
            $contact->estimate_kind = \Config::get('models.contact.estimate_kind.'.$estimate_kind);

            if ($contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract'))
            {
                if ($prefecture_code = \Input::get('prefecture_code'))
                {
                    $contact->new_prefecture_code = $prefecture_code;
                }

                if ($zip_code = \Input::get('zip_code'))
                {
                    $contact->new_zip_code = $zip_code;
                }
            }
            else
            {
                if ($prefecture_code = \Input::get('prefecture_code'))
                {
                    $contact->prefecture_code = $prefecture_code;
                }

                if ($zip_code = \Input::get('zip_code'))
                {
                    $contact->zip_code = $zip_code;
                }
            }
        }

        $this->template = \View::forge('front/template_old');
        $this->template->title = 'お見積もり情報入力';
        $this->template->content = View::forge('front/contacts/old', [
            'val' => \Model_Contact::validate('old_form'),
            'contact' => $contact,
            'apartment_form' => \Input::get('apartment_form') ? true : false,
        ]);
    }

    /**
     * Complete action
     *
     * @access  public
     * @return  Response
     */
    public function get_done()
    {
        $this->template = \View::forge('front/template_match_screen');

        $contact_id = str_replace('LPGAS-', '', \Input::get('conversion_id'));

        $contact = \Model_Contact::find($contact_id);

        if (!$contact)
        {
            \Log::warning("conversion id {$contact_id} not found");
            throw new HttpNotFoundException();
        }

        // var_dump($contact->tracking->conversion_tag);exit;


        $this->template->contact = $contact;
        $this->template->title = 'エネピ -  お見積もりの問い合わせ完了';
        
        $this->template->content = View::forge('front/contacts/done', [
            'contact' => $contact,
        ]);

        $this->template->content->set_global('cv_point', \Config::get('models.tracking.cv_point.estimate'));
    }

    /**
     * Show sms confirm view
     *
     * @access  public
     * @return  Response
     */
    public function get_sms_confirm($contact_id)
    {
        $contact = \Model_Contact::find($contact_id);
        $token = \Input::get('token');
        $pin = \Input::get('pin');

        if (!$contact || !$token || $token != $contact->token)
        {
            \Log::warning('Invalit input on front/get_sms_confirm');
            throw new HttpNotFoundException();
        }

        // SMS認証画面で入力した値が間違っていた場合SMS認証画面に戻る
        if ($pin && $pin != $contact->pin)
        {
            \Log::warning('Wrong pin');
            return \Response::redirect("lpgas/contacts/{$contact->id}?".http_build_query(['conversion_id' => 'LPGAS-'.$contact->id, 'token' => $token]));
        }

        // WTF?
        // SMS認証画面
        if(!$pin)
        {
            $this->template = \View::forge('front/template_contact');



            $header_decision = 'other';
            $pin = \Input::get('pin');



            $pr_tracking_parameter_name = '';

            if(!is_null($contact->tracking))
            {
                $pr_tracking_parameter_name = $contact->tracking->name;
            }

            $re_cv_params = ['contact_id' => $contact->id, 'token' => \Input::get('token'), 'pr' => $pr_tracking_parameter_name];
            $re_cv_url = null;



            if(!is_null($contact->from_kakaku))
            {
                $endpoint = 'https://propanegas.kakaku.com';
                if($_SERVER['FUEL_ENV'] == \Fuel::DEVELOPMENT)
                {
                    $endpoint = '';
                }

                elseif($_SERVER['FUEL_ENV'] == \Fuel::STAGING)
                {
                    $endpoint = 'https://stg.kakaku.enepi.jp';
                }

                $re_cv_url = $endpoint.'/'.$this->lpgas_contact_path($re_cv_params, $contact);
            }

            elseif(!is_null($contact->from_enechange))
            {
                $re_cv_url = $this->lpgas_contact_path($re_cv_params, $contact);
            }

            else
            {
                $re_cv_params_query = '認証画面';
                foreach($re_cv_params as $key => $value)
                {
                    $re_cv_params_query = $re_cv_params_query.$key.'='.$value.'&';
                }
                $re_cv_url = '/lpgas_contacts/new_form?'.$re_cv_params_query;
            }

            Tracking::unsetTracking();

            $this->template->title = 'エネピ';
            $this->template->header = View::forge('front/contacts/lpgas_contacts_header');
            $this->template->content = View::forge('front/contacts/sms_confirm', [
                'contact' => $contact,
                'pin' => $pin,
                're_cv_url' => $re_cv_url,
            ], false);
            $this->template->content->set_global('cv_point', \Config::get('models.tracking.cv_point.estimate'));
            $this->template->footer = View::forge('front/contacts/lpgas_contacts_footer');
            $this->template->css_call = 'presentation';
        }
        // お客様マイページ
        else
        {
            // Don't update if logged in as Admin
            if (!Eauth::check('admin'))
            {
                $contact->is_seen = \Config::get('models.contact.is_seen.seen');
                $contact->save();
            }

            $this->template = \View::forge('front/template_match_screen');

            $estimates = \Model_Estimate::find('all', [
                'where' => [
                    ['contact_id', $contact->id],
                    ['status', 'in', [
                        \Config::get('models.estimate.status.sent_estimate_to_user'),
                        \Config::get('models.estimate.status.verbal_ok'),
                        \Config::get('models.estimate.status.contracted'),
                    ]],
                ],
            ]);

            $this->template->title = 'あなたの条件にマッチしたガス会社';
            $this->template->contact = $contact;

            $this->template->content = View::forge('front/contacts/estimates_match', [
                'contact' => $contact,
                'estimates' => $estimates,
            ]);

            // WTF?
            if($contact->status == \Config::get('models.contact.status.sent_estimate_req'))
            {
                $this->template->content->set_global('cv_point', \Config::get('models.tracking.cv_point.estimate'));
            }
            elseif($contact->status == \Config::get('models.contact.status.verbal_ok'))
            {
                $this->template->content->set_global('cv_point', \Config::get('models.tracking.cv_point.verbal_ok'));
            }
        }
    }

    // WTF?
    public function get_details($contact_id, $uuid)
    {
        $contact = \Model_Contact::find($contact_id);
        $token = \Input::get('token');
        $pin = \Input::get('pin');

        if (!$contact || !$token || !$pin || $contact->token != $token || $contact->pin != $pin)
        {
            \Log::warning('Invalid params on front/get_details');
            throw new HttpNotFoundException();
        }

        $this->template = \View::forge('front/template_contact');

        $estimate = \Model_Estimate::find('first',[
            'where' => [
                ['uuid', $uuid],
            ],
        ]);

        if (!$estimate)
        {
            \Log::warning("conversion id {$uuid} not found");
            throw new HttpNotFoundException();
        }

        if ($estimate->isExpired())
        {
            Session::set_flash('alert', 'この見積もりの有効期限は切れています');
        }

        $feature_all = \Model_Company_Feature::find('all');

        if (!$feature_all)
        {
            \Log::warning("CompanyFeature not found");
            throw new HttpNotFoundException();
        }



        $company = [];

        foreach ($contact->estimate as $e){
            if($e->uuid == $uuid){
                $company = $e;
            }
        }



        if(is_array($estimate->savings_by_month($contact)))
        {
            $data = [
                    'cols' => [
                            ['id' => '','label' => '月','pattern' => '','type' => 'string'],
                            ['id' => '','label' => '地域平均','pattern' => '','type' => 'number'],
                            ['id' => '','label' => 'エネピ平均削減額','pattern' => '','type' => 'number'],
                    ],
                    'rows' => [],
            ];

            foreach ($estimate->savings_by_month($contact) as $k => $v)
            {
                    $key = $k - 1;
                    $data['rows'][] = ['c' => [['v' => "{$k}月"], ['v' => round($v['before_price'], 0)], ['v' => round($v['after_price'], 0)]]];
            }

            $google_chart_json_data = json_encode($data);
        }
        else
        {
            $google_chart_json_data = null;
        }



        $flash_message_est = Model_Estimate::find('all', [
            'where' => [
                ['contact_id', $contact->id],
                ['status', \Config::get('models.estimate.status.verbal_ok')],
            ]
        ]);

        if($flash_message_est)
        {
            $company_name = '';
            $estimate_verbal_ok_count = 0;

            foreach($flash_message_est as $e)
            {
                if($estimate_verbal_ok_count == 0)
                {
                    $company_name = $e->company->display_name;
                    $estimate_verbal_ok_count++;
                }
                else
                {
                    $company_name = $company_name.'、'.$e->company->display_name;
                }
            }
            Session::set_flash('estimate_verbal_ok_message', $company_name.'に依頼済みです');
        }



        $flash_message_notice = Model_Estimate::find('all', [
            'where' => [
                ['contact_id', $contact->id],
                ['status', \Config::get('models.estimate.status.verbal_ok')],
                ['status', \Config::get('models.estimate.status.contracted')],
            ]
        ]);

        if(!is_null($flash_message_notice))
        {
            if($contact->status == \Config::get('models.contact.status.contracted'))
            {
                foreach($flash_message_notice as $n)
                {
                    if($n->status == Config::get('models.estimate.status.contracted'))
                    {
                        Session::set_flash('notice', $n->company->display_name.'に依頼済みです');
                    }

                }
            }
            elseif($contact->status == \Config::get('models.contact.status.verbal_ok'))
            {
                $company_display_name = '';
                $estimate_verbal_ok_count = 0;
                foreach($flash_message_notice as $n)
                {
                    if($n->status == Config::get('models.estimate.status.verbal_ok'))
                    {
                        if($estimate_verbal_ok_count == 0)
                        {
                            $company_display_name = $n->company->display_name;
                            $estimate_verbal_ok_count++;
                        }
                        else
                        {
                            $company_display_name = $company_display_name.'、'.$n->company->display_name;
                        }
                    }
                }
                Session::set_flash('notice', $company_display_name.'に依頼済みです');
            }
        }

        $header_decision = 'other';
        $prefecture_KanjiAndCode = JpPrefecture::allKanjiAndCode();
        $prefecture_kanji = $this->prefecture_kanji($prefecture_KanjiAndCode, $contact->getPrefectureCode());


        $this->template->title = 'あなたの条件にマッチしたガス会社の詳細ページ';
        $this->template->header = View::forge('front/contacts/lpgas_contacts_header');
        $this->template->content = View::forge('front/contacts/details', [
            'contact' => $contact,
            'prefecture_kanji' => $prefecture_kanji,
            'company' => $company,
            'estimate' => $estimate,
            'feature_all' => $feature_all,
            'google_chart_json_data' => $google_chart_json_data,
        ]);
        $this->template->footer = View::forge('front/contacts/lpgas_contacts_footer');
        $this->template->css_call = 'details';

    }

    public function post_introduce($contact_id)
    {
        $contact = \Model_Contact::find($contact_id);
        $token = \Input::post('token');
        $pin = \Input::post('pin');

        $preferred_time = \Input::post('preferred_time', null);
        $priority_degree = \Input::post('priority_degree', null);
        $desired_option = \Input::post('desired_option', null);

        if (!$contact || !$token || !$pin || $contact->token != $token || $contact->pin != $pin)
        {
            \Log::warning('Invalid input on front/post_introduce');
            throw new HttpNotFoundException();
        }

        $updated = false;

        if ($estimates = \Input::post('estimates', []))
        {
            $not_introduce = \Model_Estimate::find('all', [
                'where' => [
                    ['contact_id', $contact_id],
                    ['status', \Config::get('models.estimate.status.sent_estimate_to_user')],
                ]
            ]);

            foreach ($not_introduce as $estimate)
            {
                if (in_array($estimate->id, $estimates))
                {
                    $updated = true;
                    $estimate->introduce(null, null, $contact_id);
                }
            }
        }

        if ($updated)
        {
            if ($contact->status == \Config::get('models.contact.status.sent_estimate_req'))
            {
                $contact->status = \Config::get('models.contact.status.verbal_ok');
            }
        }

        if ($preferred_time !== null)
        {
            $contact->preferred_contact_time_between = $preferred_time;
        }

        if ($priority_degree !== null)
        {
            $contact->priority_degree = $priority_degree;
        }

        if ($desired_option !== null)
        {
            $contact->desired_option = $desired_option;
        }

        if ($updated || $preferred_time !== null || $priority_degree !== null || $desired_option !== null)
        {
            $contact->save();
        }

        return \Response::redirect("lpgas/contacts/{$contact_id}?".http_build_query(['conversion_id' => 'LPGAS-'.$contact->id, 'pin' => $pin, 'token' => $token]));
    }

    private function calculateGasUsage(&$contact)
    {
        $house_hold = \Config::get('enepi.household.key_numeric_string.'.$contact->house_hold);

        $zip_code = $contact->zip_code ? $contact->zip_code : $contact->new_zip_code;
        $zip = \Model_ZipCode::find('first', ['where' => [['zip_code', str_replace('-', '', $zip_code)]]]);

        if (!$zip)
        {
            $contact->gas_used_amount = 0;
            \Log::warning('Model_ZipCode not found');

            return;
        }

        $region = \Model_Region::find('first', ['where' => [['city_name', $zip->city_name]]]);

        if (!$region)
        {
            $contact->gas_used_amount = 0;
            \Log::warning('Model_Region not found');

            return;
        }

        $city = \Model_Localcontent_City::find('first', ['where' => [['city_code', $region->id]]]);

        if ($contact->gas_meter_checked_month)
        {
            $month_str = strtolower(date('F', mktime(0, 0, 0, $contact->gas_meter_checked_month, 10)));
            $prefecture = \Model_Localcontent_Prefecture::find($city['prefecture_code']);
            $contact->gas_used_amount = round($prefecture[$month_str] / $prefecture->annual_average * $prefecture[$house_hold], 1);
        }
        else
        {
            $contact->gas_used_amount = round($city[$house_hold], 1);
        }
    }

    // WTF? Does it use?
    public function post_index()
    {

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス料金のシミュレーション結果ページです。ご入力頂いた内容を元に、今のガス代がどれくらい安くなるか算出しています。ガスの見直しにお役立てください。'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $this->template->title = 'プロパンガス料金シミュレーション 結果';
        $this->template->meta = $meta;
        $this->template->header = View::forge('front/contacts/lpgas_contacts_header');
        $this->template->content = View::forge('front/contacts/old', [
            'breadcrumb' => $breadcrumb,
        ]);
        $this->template->footer = View::forge('front/contacts/lpgas_contacts_footer');
        $this->template->css_call = 'done';

    }

    private function prefecture_kanji($prefecture_KanjiAndCode, $prefecture_code){
        $prefecture_kanji = array();

        foreach ($prefecture_KanjiAndCode as $key => $value){
            if($key == $prefecture_code){
                $prefecture_kanji = array($key => $value);
            }
        }
        return $prefecture_kanji;
    }

    // WTF? OMG! Rails comming here!
    private function lpgas_contact_path($re_cv_params, $contact){

        $lpgas_contact_path = '';
        if(\Input::method() == 'GET')
        {
            foreach(\Uri::segments() as $segments)
            {
                // ●/app/controllers/front/lpgas/contacts_controller.rbのnewメソッド
                if($segments == 'new')
                {
                    if(!empyt(\Input::get('contact_id')))
                    {
                        if($contact->token != \Input::get('token'))
                        {
                            // params.delete(:contact_id)
                            // params.delete(:token)
                            // redirect_to url_for(params)
                        }
                    }
                    else
                    {
                        // @lpgas_contact = ::Lpgas::Contact.new
                        // @lpgas_contact.from_kakaku = from_kakaku?
                        // @lpgas_contact.from_enechange = from_enechange?
                    }

                    $lpgas_contact_path = 'new';
                }
                // ●/app/controllers/front/lpgas/contacts_controller.rbのdoneメソッド
                elseif($segments == 'done')
                {
                    $lpgas_contact_path = 'done';
                }
                // ●/app/controllers/front/lpgas/contacts_controller.rbのindexメソッド
                else
                {
                  $lpgas_contact_path = 'index';
                }
            }
        }
        // ●/app/controllers/front/lpgas/contacts_controller.rbのcreateメソッド
        elseif(\Input::method() == 'POST')
        {
            $lpgas_contact_path = 'create';
        }

        return $lpgas_contact_path;

    }
}
