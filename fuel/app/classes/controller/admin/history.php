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
 * The Admin History Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_History extends Controller_Admin
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
        $this->template->content = View::forge('admin/history/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store calling history
     *
     * @access  public
     * @return  Response
     */
    public function action_store()
    {
        $val = Validation::forge('calling');

        $val->add_field('calling_method', 'calling_method', 'required|match_collection[tel,email,chat]');
        $val->add_field('note', 'note', 'required|max_length[200]');
        $val->add_field('contact_id', 'contact_id', 'required|valid_string[numeric]');

        if ($val->run())
        {
            if (!$contact = \Model_Contact::find($val->validated('contact_id'), ['related' => ['calling_histories' => ['order_by' => ['id' => 'desc']]]]))
                throw new HttpNotFoundException;

            $record = new \Model_CallingHistory();
            $record->calling_method = \Config::get('models.calling_history.calling_method.'.$val->validated('calling_method'));
            $record->note = $val->validated('note');
            $record->admin_user_id = $this->admin_id;

            $contact->calling_histories[] = $record;
            
            if ($contact->save())
            {
                Session::set_flash('success', 'OK');
                Response::redirect("admin/contacts/{$contact->id}/edit");
            }
        }

        Session::set_flash('error', 'FAIL');

        $this->template->title = 'Contact edit';
        $this->template->content = View::forge('admin/contacts/edit', [
            'contact' => $contact,
            'val' => Validation::forge(),
            'val_c' => $val_c,
        ]);
    }
}
