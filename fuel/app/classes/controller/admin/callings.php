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
class Controller_Admin_Callings extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $val = \Model_Calling::validate();

        $conditions = [
            'where' => [],
            'related' => [
                'contact' => [
                    'related' => [
                        'estimates' => [
                            'where' => [],
                        ],
                        'calling_histories',
                    ],
                    'where' => [],
                ],
            ],
        ];

        $this->updateConditions($conditions);

        $pager = \Pagination::forge('callings', [
            'name' => 'bootstrap4',
            'total_items' => \Model_Calling::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['group_by'] = ['id'];
        $conditions['rows_limit'] = $pager->per_page;
        $conditions['rows_offset'] = $pager->offset;

        $callings = \Model_Calling::find('all', $conditions);

        $this->template->title = 'callings';
        $this->template->content = View::forge('admin/callings/index', [
            'val' => $val,
            'callings' => $callings,
        ]);
    }

    /**
     * Move to archive
     *
     * @access  public
     * @return  Response
     */
    public function action_archive($id)
    {
        if (!$call = \Model_Calling::find($id))
            throw new HttpNotFoundException;

        $call->archived = true;
        $call->save();

        Session::set_flash('success', 'archived');

        Response::redirect('admin/callings');
    }

    /**
     * Private methods
     */
    private function updateConditions(&$conditions)
    {
        // Without archived
        if (!\Input::get('include_archive'))
            $conditions['where'][] = ['archived' => 0];

        // Where name equal
        if ($name_equal = \Input::get('name_equal'))
            $conditions['related']['contact']['where'][] = ['name', $name_equal];
            
        // Where name like
        if ($name_like = \Input::get('name_like'))
            $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$name_like}%"];

        // Where tel equal
        if ($tel_equal = \Input::get('tel_equal'))
            $conditions['related']['contact']['where'][] = ['tel', $tel_equal];

        // Where email equal
        if ($email_equal = \Input::get('email_equal'))
            $conditions['related']['contact']['where'][] = ['email', $email_equal];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['related']['contact']['where'][] = ['status', \Config::get('models.contact.status.'.$status)];

        // Where user status equal
        if ($user_status = \Input::get('user_status'))
            $conditions['related']['contact']['where'][] = ['user_status', \Config::get('models.contact.user_status.'.$user_status)];

        // Where estimate progress equal
        if ($estimate_progress = \Input::get('estimate_progress'))
        {
            switch ($estimate_progress)
            {
                case 'unknown':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['contacted', false];
                    break;
                case 'contacted':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['contacted', true];
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['visited', false];
                    break;
                case 'visited':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['visited', true];
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['power_of_attorney_acquired', false];
                    break;
                case 'power_of_attorney_acquired':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['power_of_attorney_acquired', true];
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_scheduled_date', NULL];
                    break;
                case 'construction_scheduled_date':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_finished_date', NULL];
                    break;
                case 'construction_finished_date':
                    $conditions['related']['contact']['related']['estimates']['where'][] = ['construction_finished_date', 'IS NOT', NULL];
                    break;
            }
        }
    }
}
