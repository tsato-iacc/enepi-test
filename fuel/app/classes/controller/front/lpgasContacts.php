<?php

use JpPrefecture\JpPrefecture;
use \Helper\Tracking;

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
//         def show
//         @lpgas_contact = ::Lpgas::Contact.find(params.require(:id))
//         @contact = @lpgas_contact

//         ::Lpgas::EstimateUserPageView.create(
//             authorized: @contact.token == params[:token],
//             terminal: terminal_type_name,
//             referrer: referrer,
//             session_id: session_id,
//             ip_address: remote_ip,
//             user_agent: user_agent,
//             contact_id: params[:id]
//             )
//             if params[:pin] == @contact.pin && !AdminSession.new(session: session, params: params).logged_in?
//             @contact.update(is_seen: 2)
//             end

//             return render_404 if @contact.token != params[:token]

//             e = @contact.estimates.detect { |e| e.contracted? }
//             flash[:notice] = "#{e.company.name}と成約済みです" if e

//             render layout: 'estimate_presentation'
//         end



        $this->template = \View::forge('front/template_contact');

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

        $header_decision = 'sms_confirm';

        $prefecture_KanjiAndCode   = JpPrefecture::allKanjiAndCode();
        $prefecture_kanji          = $this->prefecture_kanji(  $prefecture_KanjiAndCode,
                                                               $contact['prefecture_code']);

        $this->template->title = 'ENTER SMS CODE';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgasContacts/sms_confirm', [
            'contact' => $contact,
            'prefecture_kanji' => $prefecture_kanji,
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
}
