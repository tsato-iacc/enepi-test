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
 * The Admin Estimates Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Estimates extends Controller_Admin
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
            'where' => [],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company',
                    ],
                ],
                'contact' => [
                    'where' => [],
                ],
                'estimate_history',
            ],
        ];

        $this->updateConditions($conditions);

        $pager = \Pagination::forge('estimates', [
            'name' => 'bootstrap4',
            'total_items' => \Model_Estimate::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        $conditions['rows_limit'] = $pager->per_page;
        $conditions['rows_offset'] = $pager->offset;

        $estimates = \Model_Estimate::find('all', $conditions);
        $this->template->title = 'Estimates';
        $this->template->content = View::forge('admin/estimates/index', [
            'estimates' => $estimates,
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
        if (!$estimate = \Model_Estimate::find($id, ['related' => ['contact', 'company', 'estimate_history' => ['related' => ['admin_user', 'partner_company']]]]))
            throw new HttpNotFoundException;

        $this->template->title = 'Estimate - id: '.$id;
        $this->template->content = View::forge('admin/estimates/show', [
            'estimate' => $estimate,
        ]);
    }

    /**
     * Cancel
     *
     * @access  public
     * @return  Response
     */
    public function action_cancel($id)
    {
        if (!$estimate = \Model_Estimate::find($id, ['related' => ['estimate_history', 'company']]))
            throw new HttpNotFoundException;
        
        if ($status_reason = \Input::post('status_reason'))
        {
            if ($estimate->cancel($this->admin_id, $status_reason))
            {
                Session::set_flash('success', "ID: {$id} ステータスをキャンセルに変更しました");

                return Response::redirect('admin/estimates');
            }
        }

        Session::set_flash('error', "ID: {$id} ステータス変更ができませんでした");

        return Response::redirect('admin/estimates');
    }

    /**
     * Introduce
     *
     * @access  public
     * @return  Response
     */
    public function action_introduce($id)
    {
        if (!$estimate = \Model_Estimate::find($id, ['related' => ['estimate_history', 'company', 'contact']]))
            throw new HttpNotFoundException;

        if ($estimate->introduce($this->admin_id))
        {
            $query = [
                // 'conversion_id' => "LPGAS-{$estimate->contact->id}",
                'token' => $estimate->contact->token,
                'pin' => $estimate->contact->pin,
            ];

            return \Response::redirect("lpgas/contacts/{$estimate->contact->id}?".http_build_query($query));
        }

        Session::set_flash('error', "ID: {$id} introduce FAIL");

        return Response::redirect('admin/estimates');
    }

    /**
     * Introduce
     *
     * @access  public
     * @return  Response
     */
    public function action_present($id)
    {
        if (!$estimate = \Model_Estimate::find($id, ['related' => ['estimate_history', 'company']]))
            throw new HttpNotFoundException;

        if ($estimate->present($this->admin_id))
        {
            Session::set_flash('success', "ID: {$id} ユーザーに送信しました");

            return Response::redirect('admin/estimates');
        }

        Session::set_flash('error', "ID: {$id} ユーザーに送信 FAIL");

        return Response::redirect('admin/estimates');
    }

    private function updateConditions(&$conditions)
    {
        // Where contact name equal
        if ($contact_name_equal = \Input::get('contact_name_equal'))
            $conditions['related']['contact']['where'][] = ['name', $contact_name_equal];
            
        // Where contact name like
        if ($contact_name_like = \Input::get('contact_name_like'))
            $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$contact_name_like}%"];
        
        // Where company id equal
        if ($company_id = \Input::get('company_id'))
            $conditions['where'][] = ['company_id', $company_id];

        // Where company contact name like
        if ($company_contact_name_like = \Input::get('company_contact_name_like'))
            $conditions['where'][] = ['company_contact_name', 'LIKE', "%{$company_contact_name_like}%"];

        // Where tel equal
        if ($contact_tel_equal = \Input::get('contact_tel_equal'))
            $conditions['related']['contact']['where'][] = ['tel', $contact_tel_equal];

        // Where email equal
        if ($email_equal = \Input::get('email_equal'))
            $conditions['related']['contact']['where'][] = ['email', $email_equal];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.estimate.status.'.$status)];

        // Where estimate progress equal
        if ($estimate_progress = \Input::get('estimate_progress'))
        {
            switch ($estimate_progress)
            {
                case 'unknown':
                    $conditions['where'][] = ['contacted', false];
                    break;
                case 'contacted':
                    $conditions['where'][] = ['contacted', true];
                    $conditions['where'][] = ['visited', false];
                    break;
                case 'visited':
                    $conditions['where'][] = ['visited', true];
                    $conditions['where'][] = ['power_of_attorney_acquired', false];
                    break;
                case 'power_of_attorney_acquired':
                    $conditions['where'][] = ['power_of_attorney_acquired', true];
                    $conditions['where'][] = ['construction_scheduled_date', NULL];
                    break;
                case 'construction_scheduled_date':
                    $conditions['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
                    $conditions['where'][] = ['construction_finished_date', NULL];
                    break;
                case 'construction_finished_date':
                    $conditions['where'][] = ['construction_finished_date', 'IS NOT', NULL];
                    break;
            }
            
        }

        if ($created_from = \Input::get('created_from'))
        {
            $conditions['where'][] = ['created_at', '>=', $created_from];
        }

        if ($created_to = \Input::get('created_to'))
        {
            $conditions['where'][] = ['created_at', '<=', $created_to];
        }

        if ($preferred_time = \Input::get('preferred_time'))
        {
            $conditions['related']['contact']['where'][] = ['preferred_contact_time_between', $preferred_time];
        }
    }
}
