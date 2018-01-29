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

        $conditions = [
            'where' => [],
            'related' => [
                'estimates' => [
                    'where' => [],
                ],
                'calling_histories',
            ],
        ];

        $this->updateConditions($conditions);

        $pager = \Pagination::forge('contacts', [
            'name' => 'bootstrap4',
            'total_items' => \Model_Contact::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        $conditions['limit'] = $pager->per_page;
        $conditions['offset'] = $pager->offset;

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

        Response::redirect('admin/callings');
    }

    /**
     * Private methods
     */
    private function updateConditions(&$conditions)
    {
        // Without archived
        // if (!\Input::get('include_archive'))
        //     $conditions['where'][] = ['archived' => 0];

        // // Where name equal
        // if ($name_equal = \Input::get('name_equal'))
        //     $conditions['related']['contact']['where'][] = ['name', $name_equal];
            
        // // Where name like
        // if ($name_like = \Input::get('name_like'))
        //     $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$name_like}%"];

        // // Where tel equal
        // if ($tel_equal = \Input::get('tel_equal'))
        //     $conditions['related']['contact']['where'][] = ['tel', $tel_equal];

        // // Where email equal
        // if ($email_equal = \Input::get('email_equal'))
        //     $conditions['related']['contact']['where'][] = ['email', $email_equal];

        // // Where status equal
        // if ($status = \Input::get('status'))
        //     $conditions['related']['contact']['where'][] = ['status', \Config::get('models.contact.status.'.$status)];

        // // Where user status equal
        // if ($user_status = \Input::get('user_status'))
        //     $conditions['related']['contact']['where'][] = ['user_status', \Config::get('models.contact.user_status.'.$user_status)];

        // // Where estimate progress equal
        // if ($estimate_progress = \Input::get('estimate_progress'))
        // {
        //     switch ($estimate_progress)
        //     {
        //         case 'unknown':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['contacted', false];
        //             break;
        //         case 'contacted':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['contacted', true];
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['visited', false];
        //             break;
        //         case 'visited':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['visited', true];
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['power_of_attorney_acquired', false];
        //             break;
        //         case 'power_of_attorney_acquired':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['power_of_attorney_acquired', true];
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_scheduled_date', NULL];
        //             break;
        //         case 'construction_scheduled_date':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_finished_date', NULL];
        //             break;
        //         case 'construction_finished_date':
        //             $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_finished_date', 'IS NOT', NULL];
        //             break;
        //     }
            
        // }
    }
}
