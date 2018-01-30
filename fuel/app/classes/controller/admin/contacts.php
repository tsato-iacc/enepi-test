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
 * The Admin LpgasCallings Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Contacts extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $val = Validation::forge();

        // UPGRADE ME, Use group by than where in
        $conditions = [
            'where' => [],
            'related' => [
                'estimates' => [
                    'where' => [],
                ],
                'calling_histories',
            ],
        ];

        $related_where = $this->updateConditions($conditions);

        $pager = \Pagination::forge('contacts', [
            'name' => 'bootstrap4',
            'total_items' => \Model_Contact::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        
        if ($related_where)
        {
            $conditions['rows_limit'] = $pager->per_page;
            $conditions['rows_offset'] = $pager->offset;
        }
        else
        {
            $conditions['limit'] = $pager->per_page;
            $conditions['offset'] = $pager->offset;
        }

        $contacts = \Model_Contact::find('all', $conditions);

        $this->template->title = 'contacts';
        $this->template->content = View::forge('admin/contacts/index', [
            'val' => $val,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Edit
     *
     * @access  public
     * @return  Response
     */
    public function action_edit($contact_id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/contacts/edit', [
            'test' => 'test'
        ]);
    }

    /**
     * Update
     *
     * @access  public
     * @return  Response
     */
    public function action_update($contact_id)
    {
        print "UPDATE CONTACT";exit;
        Response::redirect("admin/companies/{$contact_id}/edit");
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_estimate_create()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/contacts/estimate_create', [
            'test' => 'test'
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
        if (!$contact = \Model_Contact::find($id))
            throw new HttpNotFoundException;

        if ($reason = \Input::post('status_reason'))
        {
            $contact->cancel($this->admin_id, $reason);
            Session::set_flash('success', 'cancel');
        }
        else
        {
            Session::set_flash('error', 'cancelできませんでした');
        }

        Response::redirect('admin/contacts');
    }

    /**
     * Private methods
     */
    private function updateConditions(&$conditions)
    {
        $related_where = false;

        // Where name equal
        if ($name_equal = \Input::get('name_equal'))
            $conditions['where'][] = ['name', $name_equal];
            
        // Where name like
        if ($name_like = \Input::get('name_like'))
            $conditions['where'][] = ['name', 'LIKE', "%{$name_like}%"];

        // Where tel equal
        if ($tel_equal = \Input::get('tel_equal'))
            $conditions['where'][] = ['tel', $tel_equal];

        // Where email equal
        if ($email_equal = \Input::get('email_equal'))
            $conditions['where'][] = ['email', $email_equal];

        // Where house kind equal
        if ($house_kind = \Input::get('house_kind'))
            $conditions['where'][] = ['house_kind', \Config::get('models.contact.house_kind.'.$house_kind)];

        // Where ownership kind equal
        if ($ownership_kind = \Input::get('ownership_kind'))
            $conditions['where'][] = ['ownership_kind', \Config::get('models.contact.ownership_kind.'.$ownership_kind)];

        // Where new_prefecture_code equal
        if ($new_pref_code = \Input::get('new_pref_code'))
            $conditions['where'][] = ['new_prefecture_code', $new_pref_code];

        // Where prefecture_code equal
        if ($pref_code = \Input::get('pref_code'))
            $conditions['where'][] = ['prefecture_code', $pref_code];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.contact.status.'.$status)];

        // Where user status equal
        if ($user_status = \Input::get('user_status'))
            $conditions['where'][] = ['user_status', \Config::get('models.contact.user_status.'.$user_status)];

        // Where contact created from
        if ($created_from = \Input::get('created_from'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];

        // Where contact created to
        if ($created_to = \Input::get('created_to'))
            $conditions['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to)];

        // Where introduce created from
        if ($introduced_from = \Input::get('introduced_from'))
        {
            $related_where = true;
            $conditions['related']['estimates']['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($introduced_from)];
        }

        // Where introduce created to
        if ($introduced_to = \Input::get('introduced_to'))
        {
            $related_where = true;
            $conditions['related']['estimates']['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($introduced_to)];
        }

        // Where estimate progress equal
        if ($estimate_progress = \Input::get('estimate_progress'))
        {
            $related_where = true;

            switch ($estimate_progress)
            {
                case 'unknown':
                    $conditions['related']['estimates']['where'][] = ['contacted', false];
                    break;
                case 'contacted':
                    $conditions['related']['estimates']['where'][] = ['contacted', true];
                    $conditions['related']['estimates']['where'][] = ['visited', false];
                    break;
                case 'visited':
                    $conditions['related']['estimates']['where'][] = ['visited', true];
                    $conditions['related']['estimates']['where'][] = ['power_of_attorney_acquired', false];
                    break;
                case 'power_of_attorney_acquired':
                    $conditions['related']['estimates']['where'][] = ['power_of_attorney_acquired', true];
                    $conditions['related']['estimates']['where'][] = ['construction_scheduled_date', NULL];
                    break;
                case 'construction_scheduled_date':
                    $conditions['related']['estimates']['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
                    $conditions['related']['estimates']['where'][] = ['construction_finished_date', NULL];
                    break;
                case 'construction_finished_date':
                    $conditions['related']['estimates']['where'][] = ['construction_finished_date', 'IS NOT', NULL];
                    break;
            }
        }

        return $related_where;
    }
}
