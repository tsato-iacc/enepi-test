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
class Controller_Front_LpgasContacts extends Controller_Front
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
        $this->template = \View::forge('front/template_contact');

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgasContacts/index', [
            'contact' => new \Model_Contact(),
            'month_selected' => '',
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
        $contact = new \Model_Contact();

        $contact->pr_tracking_parameter_id = $this->pr_tracking_id;
        $contact->from_kakaku = $this->from_kakaku;
        $contact->from_enechange = $this->from_enechange;
        $contact->terminal = \Config::get('enepi.terminal_types.'.$this->terminal_type);

        if ($contact_id = \Input::post('contact_id') && $token = \Input::post('token'))
        {
            if ($original = \Model_Contact::find($contact_id) && $original->token = $token)
                $contact->original_contact_id = $original->id;
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

            if (\Input::post('simple_simulation') == true)
                $contact->body = "「世帯人数：{$contact->house_hold}　シミュレーションにより使用量：{$contact->gas_used_amount}m3で推定入力」";

            \DB::start_transaction();
            try
            {
                $contact->save();
                \DB::commit_transaction();

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
                // FIX ME
                throw $e;
            }
        }

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス会社を簡単ネット見積もり'],
            ['name' => 'keywords', 'content' => 'プロパンガス,見積もり'],
        ];

        // Old form or API request
        if ($validation_factory == 'old_form')
        {
            $this->template = \View::forge('front/template_contact');

            $view = \View::forge('front/lpgasContacts/old', [
                'contact' => $contact,
                'val' => $val,
                'apartment_form' => \Input::post('apartment_form') ? true : false,
            ]);
        }
        else
        {
            $view = \View::forge('front/lpgasContacts/index', [
                'contact' => $contact,
                'val' => $val,
                'month_selected' => '',
            ]);
        }

        $this->template->title = 'お見積もり情報入力';
        $this->template->meta = $meta;
        $this->template->content = $view;
    }

    /**
     * Old estimate form
     *
     * @access  public
     * @return  Response
     */
    public function get_old()
    {
        $this->template = \View::forge('front/template_contact');

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス会社を簡単ネット見積もり'],
            ['name' => 'keywords', 'content' => 'プロパンガス,見積もり'],
        ];

        $this->template->title = 'お見積もり情報入力';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgasContacts/old', [
            'val' => \Model_Contact::validate('old_form'),
            'contact' => new \Model_Contact(),
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
        $this->template = \View::forge('front/template_contact');

        $contact_id = str_replace('LPGAS-', '', \Input::get('conversion_id'));

        $contact = \Model_Contact::find($contact_id);

        if (!$contact)
        {
            \Log::warning("conversion id {$contact_id} not found");
            throw new HttpNotFoundException();
        }

        Tracking::unsetTracking();

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $header_decision = 'done';

        $this->template->title = 'DONE';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgasContacts/done', [
            'contact' => $contact
        ]);
        $this->template->header_decision = $header_decision;
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
        if (!$contact)
        {
            \Log::warning("conversion id {$contact_id} not found");
            throw new HttpNotFoundException();
        }

        Tracking::unsetTracking();

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        if(!is_null(\Input::get('conversion_id')) || \Input::get('pin') != $contact->pin)
        {
            $this->template = \View::forge('front/template_contact');


            $header_decision = 'sms_confirm';
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
                $re_cv_url = $endpoint.'/'.$this->lpgas_contact_path($re_cv_params, $contact);
            }
            elseif(!is_null($contact->from_enechange))
            {
                $re_cv_url = $this->lpgas_contact_path($re_cv_params, $contact);
            }
            else
            {
                $re_cv_params_query = '';
                foreach($re_cv_params as $key => $value)
                {
                    $re_cv_params_query = $re_cv_params_query.$key.'='.$value.'&';
                }
                $re_cv_url = '/lpgas_contacts/new_form?'.$re_cv_params_query;
            }


            $this->template->title = 'ENTER SMS CODE';
            $this->template->meta = $meta;
            $this->template->content = View::forge('front/lpgasContacts/sms_confirm', [
                'contact' => $contact,
                'pin' => $pin,
                'no_breadcrumb' => $this->no_breadcrumb,
                'no_drawer_menu' => $this->no_drawer_menu,
                're_cv_url' => $re_cv_url,
            ]);
            $this->template->header_decision = $header_decision;

        }
        elseif(!is_null(\Input::get('pin')))
        {
            $this->template = \View::forge('front/template_contact');

            $contact = \Model_Contact::find($contact_id);
            if (!$contact)
            {
                \Log::warning("conversion id {$contact_id} not found");
                throw new HttpNotFoundException();
            }

//             foreach ($contact->estimate as $key => $value) {
//                 if($contact->estimate[$key]->basic_price == null) {
//                     unset($contact->estimate[$key]);
//                 }
//             }

            $prefecture_data = \Model_LocalContentPrefecture::find($contact['prefecture_code']);
            if (!$prefecture_data)
            {
                \Log::warning("prefecture_code {$contact['prefecture_code']} not found");
                throw new HttpNotFoundException();
            }

            Tracking::unsetTracking();

            $meta = [
                ['name' => 'description', 'content' => 'OOooOOppp'],
                ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
                ['name' => 'puka', 'content' => 'suka'],
            ];

            $header_decision = 'estimate_presentation';

            $prefecture_KanjiAndCode   = JpPrefecture::allKanjiAndCode();
            $prefecture_kanji          = $this->prefecture_kanji(  $prefecture_KanjiAndCode,
                $contact['prefecture_code']);

            $this->template->title = 'エネピ';
            $this->template->meta = $meta;
            $this->template->content = View::forge('front/lpgasContacts/estimate_presentation', [
                'contact' => $contact,
                'prefecture_kanji' => $prefecture_kanji,
                'prefecture_data' => $prefecture_data,
            ]);
            $this->template->header_decision = $header_decision;
        }
    }

    public function get_details($contact_id, $uuid)
    {
        $this->template = \View::forge('front/template_contact');

        $contact = \Model_Contact::find($contact_id);
        if (!$contact)
        {
            \Log::warning("conversion id {$contact_id} not found");
            throw new HttpNotFoundException();
        }

//         foreach ($contact->estimate as $key => $value) {
//             if($contact->estimate[$key]->basic_price == null) {
//                 unset($contact->estimate[$key]);
//             }
//         }

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

        Tracking::unsetTracking();

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $header_decision = 'details';

        $prefecture_KanjiAndCode   = JpPrefecture::allKanjiAndCode();
        $prefecture_kanji          = $this->prefecture_kanji(  $prefecture_KanjiAndCode,
            $contact['prefecture_code']);

        $used_amount_by_month = $this->used_amount_by_month($contact);

        $savings_by_month = $this->savings_by_month($contact, $company, $used_amount_by_month);

//        var_dump($savings_by_month);

        $this->template->title = 'エネピ';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgasContacts/details', [
            'contact' => $contact,
            'prefecture_kanji' => $prefecture_kanji,
            'company' => $company,
            'estimate' => $estimate,
            'feature_all' => $feature_all,
            'savings_by_month' => $savings_by_month,
        ]);
        $this->template->header_decision = $header_decision;
    }



    private function calculateGasUsage(&$contact)
    {
        $house_hold = \Config::get('enepi.household.key_numeric_string.'.$contact->house_hold);

        $zip_code = $contact->zip_code ? $contact->zip_code : $contact->new_zip_code;
        $zip = \Model_ZipCode::find('first', ['where' => [['zip_code', str_replace('-', '', $zip_code)]]]);

        $region = \Model_Region::find('first', ['where' => [['city_name', $zip->city_name]]]);

        if (!$region)
        {
            $contact->gas_used_amount = 0;
            \Log::warning('Region not found');

            return;
        }

        $city = \Model_LocalContentCity::find('first', ['where' => [['city_code', $region->id]]]);

        if ($contact->gas_meter_checked_month)
        {
            $prefecture = \Model_LocalContentPrefecture::find($city->prefecture_code);
            $contact->gas_used_amount = round($prefecture[$contact->gas_meter_checked_month] / $prefecture->annual_average * $prefecture[$house_hold], 1);
        }
        else
        {
            $contact->gas_used_amount = round($city[$house_hold], 1);
        }
    }


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
        $this->template->content = View::forge('front/lpgasContacts/old', [
            'breadcrumb' => $breadcrumb,
        ]);

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

    private function used_amount_by_month($contact){

        if(isset($contact['prefecture_code']))
        {
            $pref_model = JpPrefecture::usedAmountModel($contact['prefecture_code']);
        }
        else
       {
            $pref_model = JpPrefecture::usedAmountModel($contact['new_prefecture_code']);
        }

        $a = 1.0 / $pref_model[$contact['gas_meter_checked_month']];
        $used_amount_by_month = [];

        for($month = 0; $month < 12; $month++)
        {
            $m = $month + 1;
            $used_amount_by_month[$m] = $contact->gas_used_amount * $a * $pref_model[$m];
        }

        return $used_amount_by_month;
    }

    private function savings_by_month($contact, $company, $used_amount_by_month)
    {
        $savings_by_month = [];

        if(!is_null($company->basic_price))
        {
            return null;
        }
        elseif(!isset($_savings_by_month))
        {
            return $savings_by_month;
        }

        for($month = 0; $month < 12; $month++)
        {
            $m = $month + 1;
            $used_amount = $used_amount_by_month[$m];

            $savings_by_month[$m] = [
                'id' => $company->id,
                'used_amount' => $used_amount,
                'before_price' => round($this->basic_price($contact) + $this->unit_price($contact) * $used_amount),
                'after_price' => round($company->basic_price + $this->calc_ondemand_cost($contact, $used_amount)),
            ];
        }
        return $savings_by_month;

    }

    private function basic_price($contact){
        return JpPrefecture::basicPricePrefecture($contact['prefecture_code']);
    }

    private function unit_price($contact){

        $unit_price = 0;
        if(!empty($contact->gas_latest_billing_amount) && !empty($contact->gas_used_amount))
        {
            if($contact->gas_used_amount == 0)
            {
                return $unit_price = 0;
            }
            return $unit_price = (($contact->gas_latest_billing_amount / 1.08) - (float)$basic_price) / $contact->gas_used_amount;
        }

        return $unit_price;
    }

    private function calc_ondemand_cost($contact, $used_amount){

        $sum = $contact->fuel_adjustment_cost * $used_amount;

        foreach ($contact->estimate as $e)
        {
            foreach($e->prices as $p)
            {
                if($used_amount <= $p->upper_limit - $p->under_limit)
                {
                    $sum += ($p->unit_price * $used_amount);
                    break;
                }
                else
              {
                    $used_amount -= $p->upper_limit - $p->under_limit;
                    $sum += $p->unit_price * ($p->upper_limit - $p->under_limit);
                }
            }
        }

        return $sum;

    }

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
                    // if params[:estimate_kind].present?
                    //   begin
                    //     @lpgas_contact.estimate_kind = params[:estimate_kind]
                    //   rescue ArgumentError
                    //     # クエリパラメータ estimate_kind に不正な値が入ってくることはあり(URLコピペミス等)、
                    //     # かつ、重要なものでもないので無視
                    //   end
                    // end
                    // if params[:zip_code].present?
                    //   if @lpgas_contact.new_contract?
                    //     @lpgas_contact.new_zip_code = params[:zip_code]
                    //   else
                    //     @lpgas_contact.zip_code = params[:zip_code]
                    //   end
                    // end
                    // if params[:prefecture_code].present?
                    //   if @lpgas_contact.new_contract?
                    //     @lpgas_contact.new_prefecture_code = params[:prefecture_code]
                    //   else
                    //     @lpgas_contact.prefecture_code = params[:prefecture_code]
                    //   end
                    // end

                    // if from_kakaku?
                    //   @form_url = '/kakaku/lpgas/contacts'
                    //   return render :kakaku
                    // end

                    $lpgas_contact_path = 'new';
                }
                // ●/app/controllers/front/lpgas/contacts_controller.rbのdoneメソッド
                elseif($segments == 'done')
                {
                    // # FOR OLD FORM
                    // if params[:enepi_security_key].present?
                    //   @contact = ::Lpgas::Contact.find(params[CONVERSION_PARAM].gsub(/^LPGAS-/, ""))
                    //   unset_pr_tracking_parameter
                    //   render 'done_old'
                    // else
                    //   @contact = ::Lpgas::Contact.find(params[CONVERSION_PARAM].gsub(/^LPGAS-/, ""))
                    //   unset_pr_tracking_parameter
                    // end
                    $lpgas_contact_path = 'done';
                }
                // ●/app/controllers/front/lpgas/contacts_controller.rbのindexメソッド
                else
              {
                    // raise ActionController::RoutingError, "No route matches #{request.path.inspect}"
                  $lpgas_contact_path = 'index';
                }
            }
        }
        // ●/app/controllers/front/lpgas/contacts_controller.rbのcreateメソッド
        elseif(\Input::method() == 'POST')
        {
            // # FOR OLD FORM
            // if params[:enepi_security_key].present?
            //   @lpgas_contact = ::Lpgas::Contact.new(param_lpgas_contact)
            //   @lpgas_contact.from_kakaku = from_kakaku?
            //   @lpgas_contact.from_enechange = from_enechange?
            //   @lpgas_contact.apartment_owner = @apartment_form # 集合住宅向けのフォームから
            //   @lpgas_contact.terminal = terminal_type_name
            //   @lpgas_contact.pr_tracking_parameter_id = pr_tracking_parameter.try!(:id)

            //   if params[:contact_id].present?
            //     original = ::Lpgas::Contact.find(params[:contact_id])
            //     if original.token == params[:token]
            //       @lpgas_contact.original_contact_id = original.id
            //     end
            //   end
            //   return render :nothing => true, :status => 400 unless @lpgas_contact.valid?
            //   return render_preview if params[:previewed].blank? && from_kakaku?

            //   ::Lpgas::Contact.transaction {
            //     @lpgas_contact.save!
            //     @lpgas_contact.try_auto_sending_estimates!
            //   }

            //   unless @lpgas_contact.sent_auto_estimate_req
            //     reasons = @lpgas_contact.reasons_not_auto_sendable.join(",")
            //     @lpgas_contact.update(reason_not_auto_sendable: reasons)
            //   end

            //   _params = {CONVERSION_PARAM => "LPGAS-#{@lpgas_contact.id}", enepi_security_key: 1}
            //   if from_kakaku?
            //     redirect_to done_kakaku_lpgas_contacts_path(_params)
            //   elsif @lpgas_contact.sent_auto_estimate_req
            //     redirect_to lpgas_contact_path(@lpgas_contact, _params.merge(token: @lpgas_contact.token))
            //   else
            //     redirect_to done_lpgas_contacts_path(_params)
            //   end
            // else
            //   @lpgas_contact = ::Lpgas::Contact.new(param_lpgas_contact)
            //   @lpgas_contact.from_kakaku = from_kakaku?
            //   @lpgas_contact.from_enechange = from_enechange?
            //   @lpgas_contact.apartment_owner = @apartment_form # 集合住宅向けのフォームから
            //   @lpgas_contact.terminal = terminal_type_name
            //   @lpgas_contact.pr_tracking_parameter_id = pr_tracking_parameter.try!(:id)

            //   if params[:contact_id].present?
            //     original = ::Lpgas::Contact.find(params[:contact_id])
            //     if original.token == params[:token]
            //       @lpgas_contact.original_contact_id = original.id
            //     end
            //   end

            //   # Calculate gas usage by house hold
            //   if @lpgas_contact.gas_used_amount.nil? && @lpgas_contact.house_hold.present?
            //     zip = ""
            //     fields = {
            //       '2' => 'two_or_less_person_household',
            //       '3' => 'three_person_household',
            //       '4' => 'four_person_household',
            //       '5' => 'five_person_household',
            //       '6' => 'six_person_household',
            //       '7' => 'seven_or_more_person_household'
            //     }

            //     if @lpgas_contact.zip_code.present?
            //       zip = ZipCode.find_by(zip_code: @lpgas_contact.zip_code.gsub('-', ''))
            //     else
            //       zip = ZipCode.find_by(zip_code: @lpgas_contact.new_zip_code.gsub('-', ''))
            //     end

            //     city_code = Region.where(city_name: zip.city_name).first.id
            //     city = LpgasLocalContentCity.find_by(city_code: city_code)
            //     hh = fields[@lpgas_contact.house_hold.to_s]

            //     if @lpgas_contact.gas_meter_checked_month.present?
            //       month_num = {1 => "january", 2 => "february", 3 => "march", 4 => "april", 5 => "may", 6 => "june", 7 => "july", 8 => "august", 9 => "september", 10 => "october", 11 => "november", 12 => "december"}
            //       month = month_num[@lpgas_contact.gas_meter_checked_month]
            //       prefecture = LpgasLocalContentPrefecture.find(city.prefecture_code)
            //       annual_average = prefecture.annual_average
            //       household_average_rate = prefecture.send(month) / annual_average * prefecture.send(hh)
            //     else
            //       household_average_rate = city.send(hh)
            //     end

            //     @lpgas_contact.gas_used_amount = household_average_rate.round(1)
            //   end

            //   if params[:simple_simulation].present?
            //     @lpgas_contact.body = "「世帯人数：#{@lpgas_contact.house_hold.to_s}　シミュレーションにより使用量：#{@lpgas_contact.gas_used_amount.to_s}m3で推定入力」"
            //   end

            //   if params[:new_form].present?
            //     return redirect_to '/lp/004' unless @lpgas_contact.valid?
            //   else
            //     return render :new unless @lpgas_contact.valid?
            //   end
            //   return render_preview if params[:previewed].blank? && from_kakaku?

            //   ::Lpgas::Contact.transaction {
            //     @lpgas_contact.save!
            //     @lpgas_contact.try_auto_sending_estimates!
            //   }

            //   Lpgas::ContactsMailer.notify_received_contact(@lpgas_contact).deliver_now
            //   Lpgas::ContactsMailer.thanks(@lpgas_contact).deliver_now

            //   if @lpgas_contact.sent_auto_estimate_req
            //     TwillioClient.send_sms(contact: @lpgas_contact)
            //   else
            //     reasons = @lpgas_contact.reasons_not_auto_sendable.join(",")
            //     ::Lpgas::Contact.find(@lpgas_contact.id).update(reason_not_auto_sendable: reasons)
            //   end

            //   _params = {CONVERSION_PARAM => "LPGAS-#{@lpgas_contact.id}"}
            //   if @lpgas_contact.sent_auto_estimate_req
            //     endpoint = "https://enepi.jp"
            //     if Rails.env.staging?
            //       endpoint = "https://stg.enepi.jp"
            //     elsif Rails.env.development?
            //       endpoint = "http://#{request.headers['HTTP_HOST']}"
            //     end
            //     redirect_to "#{endpoint}#{lpgas_contact_path(@lpgas_contact, _params.merge(token: @lpgas_contact.token))}"
            //   else

            //     if from_kakaku?
            //       redirect_to done_kakaku_lpgas_contacts_path(_params)
            //     else
            //       redirect_to done_lpgas_contacts_path(_params)
            //     end

            //   end
            // end
            $lpgas_contact_path = 'create';
        }

        return $lpgas_contact_path;

    }
}
