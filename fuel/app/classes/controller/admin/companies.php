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
 * The Admin LpgasCompanies Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Companies extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $val = \Model_Company::validate();

        $conditions = [
            'where' => [],
            'related' => [
                'partner_company',
            ],
        ];

        $this->updateConditions($conditions);

        $pager = \Pagination::forge('companies', [
            'name' => 'bootstrap4',
            'total_items' => \Model_Company::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        $conditions['rows_limit'] = $pager->per_page;
        $conditions['rows_offset'] = $pager->offset;

        $companies = \Model_Company::find('all', $conditions);
        $this->template->title = 'Companies';
        $this->template->content = View::forge('admin/companies/index', [
            'val' => $val,
            'companies' => $companies,
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
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/edit', [
            'test' => 'test'
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
        print "UPDATE COMPANY";exit;
        Response::redirect("admin/companies/{$id}/edit");
    }

    /**
     * Show list of estimates
     *
     * @access  public
     * @return  Response
     */
    public function action_estimates_index($id)
    {
        if (!\Model_Company::find($id))
            throw new HttpNotFoundException;

        $conditions = [
            'where' => [
                ['company_id', $id]
            ],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company'
                    ],
                ],
                'contact',
                'estimate_history',
            ],
        ];

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
        $this->template->title = 'Company estimates';
        $this->template->content = View::forge('admin/companies/estimates_index', [
            'estimates' => $estimates,
        ]);
    }

    /**
     * Show list of NG Companies
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_index($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/ng_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store NG Company
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_store($id)
    {
        print "CREATE NG";exit;
        Response::redirect("admin/companies/{$id}/ng");
    }

    /**
     * Delete NG Company
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_destroy($id, $ng_id)
    {
        print "DELETE NG";exit;
        Response::redirect("admin/companies/{$id}/ng");
    }

    /**
     * Private methods
     */
    private function updateConditions(&$conditions)
    {
        // // Where name equal
        if ($name_equal = \Input::get('name_equal'))
            $conditions['where'][] = ['display_name', $name_equal];
            
    }
}
