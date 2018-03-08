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

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * The Partner Estimates Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Partner
 */
class Controller_Partner_Estimates extends Controller_Partner
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $conditions = [
            'where' => [
                ['company_id', $this->auth_user->company->id],
            ],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company',
                    ],
                ],
                'contact' => [
                    'where' => [],
                ],
                'histories' => [
                    'where' => [
                        ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ],
                ],
            ],
        ];

        $this->updateConditions($conditions);

        $total_items = \Model_Estimate::count($conditions);

        $pager = \Pagination::forge('estimates', [
            'name' => 'bootstrap4',
            'total_items' => $total_items,
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        $conditions['rows_limit'] = $pager->per_page;
        $conditions['rows_offset'] = $pager->offset;

        $estimates = \Model_Estimate::find('all', $conditions);

        $this->checkPrivacy($estimates);
        
        $this->template->title = 'Estimates';
        $this->template->content = View::forge('partner/estimates/index', [
            'estimates' => $estimates,
            'total_items' => $total_items,
            'val' => Validation::forge(),
        ]);
    }

    /**
     * Show
     *
     * @access  public
     * @return  Response
     */
    public function action_show($id)
    {
        $estimate = \Model_Estimate::find($id, [
            'related' => [
                'contact',
                'company',
                'prices',
                'histories' => [
                    // 'where' => [
                    //     ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    // ],
                    'related' => [
                        'admin_user',
                        'partner_company'
                    ],
                ],
            ],
            'where' => [
                ['company_id', '=', $this->auth_user->company->id],
            ],
        ]);

        if (!$estimate)
            throw new HttpNotFoundException;

        if (!$estimate->is_read)
        {
            $estimate->is_read = true;
            $estimate->save();
        }

        if (\Input::extension() == 'pdf')
        {
            // $options = new Options();
            // $options->set('defaultFont', 'type1');
            // $dompdf = new Dompdf($options);
            $dompdf = new Dompdf();

            $html = View::forge('partner/estimates/show_pdf', [
                'estimate' => $estimate,
            ], false);

            $dompdf->loadHtml($html);

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();exit;
        }

        $histories = $estimate->get('histories', ['order_by' => ['id' => 'desc']]);
        $comments = $estimate->get('comments', ['where' => [['estimate_change_log_id', null]], 'order_by' => ['id' => 'desc']]);

        $timeline = $histories + $comments;

        $this->checkPrivacy($estimate);

        $this->template->title = 'Estimate - id: '.$id;
        $this->template->content = View::forge('partner/estimates/show', [
            'estimate' => $estimate,
            'timeline' => array_reverse(\Arr::sort($timeline, 'created_at', 'desc')),
        ]);
    }

    /**
     * Redirect from old url
     *
     * @access  public
     * @return  Response
     */
    public function action_show_old($uuid)
    {
        $estimate = \Model_Estimate::find('first', [
            'where' => [
                ['uuid', $uuid],
                ['company_id', '=', $this->auth_user->id],
            ],
        ]);

        if (!$estimate)
            throw new HttpNotFoundException;

        return Response::redirect("partner/estimates/{$estimate->id}");
    }

    /**
     * Cancel
     *
     * @access  public
     * @return  Response
     */
    public function action_cancel($id)
    {
        $estimate = \Model_Estimate::find($id, [
            'related' => [
                'histories' => [
                    'where' => [
                        ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ],
                ],
            ],
            'where' => [
                ['company_id', '=', $this->auth_user->id],
            ],
        ]);

        if (!$estimate)
            throw new HttpNotFoundException;
        
        if ($status_reason = \Input::post('status_reason'))
        {
            if ($estimate->cancel($this->auth_user, $status_reason))
            {
                Session::set_flash('success', "ステータスをキャンセルに変更しました");

                return Response::redirect('partner/estimates');
            }
        }

        Session::set_flash('error', "ID: {$id} ステータス変更ができませんでした");

        return Response::redirect('partner/estimates');
    }

    /**
     * Progress
     *
     * @access  public
     * @return  Response
     */
    public function action_progress($id)
    {
        if (!$estimate = \Model_Estimate::find($id, ['related' => ['company']]))
            throw new HttpNotFoundException;

        $val = Validation::forge();
        $val->add_field('contacted', 'contacted', 'match_collection[true,false]');
        $val->add_field('visited', 'visited', 'match_collection[true,false]');
        $val->add_field('power_of_attorney_acquired', 'power_of_attorney_acquired', 'match_collection[true,false]');
        $val->add_field('company_contact_name', 'company_contact_name', 'max_length[50]');

        $val->add('visit_scheduled_date', 'visit_scheduled_date')->add_rule('match_pattern', '/^\d{4}[\s.-]\d{2}[\s.-]\d{2}$/');
        $val->add('construction_scheduled_date', 'construction_scheduled_date')->add_rule('match_pattern', '/^\d{4}[\s.-]\d{2}[\s.-]\d{2}$/');
        $val->add('construction_finished_date', 'construction_finished_date')->add_rule('match_pattern', '/^\d{4}[\s.-]\d{2}[\s.-]\d{2}$/');

        if ($val->run())
        {
            \DB::start_transaction();
            try
            {
                if ($val->validated('contacted') == 'true')
                    $estimate->contacted = true;
                
                if ($val->validated('visited') == 'true')
                    $estimate->visited = true;
                
                if ($val->validated('power_of_attorney_acquired') == 'true')
                    $estimate->power_of_attorney_acquired = true;
                
                if ($val->validated('visit_scheduled_date'))
                    $estimate->visit_scheduled_date = $val->validated('visit_scheduled_date');
                
                if ($val->validated('construction_scheduled_date'))
                    $estimate->construction_scheduled_date = $val->validated('construction_scheduled_date');

                // 成約済み
                if ($val->validated('construction_finished_date'))
                {
                    if ($estimate->status != \Config::get('models.estimate.status.verbal_ok'))
                        throw new Exception('Invalid status. Should be verbal_ok');

                    $estimate->construction_finished_date = $val->validated('construction_finished_date');
                    $estimate->status = \Config::get('models.estimate.status.contracted');
                }

                if ($val->validated('company_contact_name'))
                    $estimate->company_contact_name = $val->validated('company_contact_name');

                if ($estimate->last_update_partner_company_id != $this->auth_user->id)
                    $estimate->last_update_partner_company_id = $this->auth_user->id;
                
                $is_changed = $estimate->is_changed();

                if ($estimate->save())
                {
                    // Add comment after estimate has saved and history record was created
                    if ($comment = \Input::post('comment'))
                    {
                        $history_id = null;

                        if ($is_changed)
                        {
                            $histories = \Arr::sort($estimate->histories, 'id', 'desc');
                            $h = reset($histories);
                            $history_id = $h->id;
                        }
                        
                        $comment = new \Model_Estimate_Comment(['estimate_id' => $estimate->id, 'comment' => $comment, 'estimate_change_log_id' => $history_id]);
                        $comment->save();
                    }

                    // 成約済み
                    if ($val->validated('construction_finished_date'))
                    {
                        $contact = $estimate->contact;
                        $contact->status = \Config::get('models.contact.status.contracted');
                        $contact->user_status = \Config::get('models.contact.user_status.no_action');
                        $contact->save();

                        // 成約済みになったら他の見積りをキャンセルにする
                        foreach ($contact->estimates as $e)
                        {
                            $e->cancel($this->auth_user, 'status_reason_request_by_user');
                        }
                    }

                    \DB::commit_transaction();
                    Session::set_flash('success', "更新しました");
                }

                return Response::redirect("partner/estimates/{$id}");
            }
            catch (\Exception $e)
            {
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        Session::set_flash('error', "更新できませんでした");

        return Response::redirect("partner/estimates/{$id}");
    }

    /**
     * Privet methods
     */
    private function updateConditions(&$conditions)
    {
        // Where contact name equal
        if ($contact_name_equal = \Input::get('contact_name_equal'))
            $conditions['related']['contact']['where'][] = ['name', $contact_name_equal];
            
        // Where contact name like
        if ($contact_name_like = \Input::get('contact_name_like'))
            $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$contact_name_like}%"];

        // Where company contact name like
        if ($company_contact_name_like = \Input::get('company_contact_name_like'))
            $conditions['where'][] = ['company_contact_name', 'LIKE', "%{$company_contact_name_like}%"];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.estimate.status.'.$status)];

        // Where new_prefecture_code equal
        if ($new_pref_code = \Input::get('new_pref_code'))
            $conditions['related']['contact']['where'][] = ['new_prefecture_code', $new_pref_code];

        // Where prefecture_code equal
        if ($pref_code = \Input::get('pref_code'))
            $conditions['related']['contact']['where'][] = ['prefecture_code', $pref_code];

        // Where contact created from
        if ($created_from = \Input::get('created_from'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];;

        // Where contact created to
        if ($created_to = \Input::get('created_to'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to)];

        if ($preferred_time = \Input::get('preferred_time'))
            $conditions['related']['contact']['where'][] = ['preferred_contact_time_between', $preferred_time];
    }

    private function checkPrivacy(&$mixed)
    {
        $msg = '送客後に表示されます';

        if (is_array($mixed))
        {
            foreach ($mixed as $estimate)
            {
                if (!($estimate->status == \Config::get('models.estimate.status.contracted') || $estimate->status == \Config::get('models.estimate.status.verbal_ok')))
                {
                    $estimate->contact->name = $msg;
                    $estimate->contact->furigana = $msg;
                    $estimate->contact->email = $msg;
                    $estimate->contact->tel = $msg;
                    $estimate->contact->address2 = $msg;
                    $estimate->contact->new_address2 = $msg;
                }
            }
        }
        else
        {
            if (!($mixed->status == \Config::get('models.estimate.status.contracted') || $mixed->status == \Config::get('models.estimate.status.verbal_ok')))
            {
                $mixed->contact->name = $msg;
                $mixed->contact->furigana = $msg;
                $mixed->contact->email = $msg;
                $mixed->contact->tel = $msg;
                $mixed->contact->address2 = $msg;
                $mixed->contact->new_address2 = $msg;
            }
        }
    }
}
