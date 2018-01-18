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
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/contacts/index', [
            'test' => 'test'
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

        if ($reason = \Input::post('status_reasons'))
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
}
