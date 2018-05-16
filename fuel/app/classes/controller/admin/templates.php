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
 * The Admin Users Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Templates extends Controller_Admin
{
    /**
     * Show list of users
     *
     * @access  public
     * @return  Response
     */
    public function get_index()
    {
        $this->template->title = 'メールテンプレート一覧';
        $this->template->content = View::forge('admin/templates/index', [
            'templates' => \Model_Customer_Template::find('all'),
        ]);
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_create()
    {
        $this->template->title = 'New template';
        $this->template->content = View::forge('admin/templates/create', [
            'val' => \Model_Customer_Template::validate(),
            'template' => new \Model_Customer_Template(),
        ]);
    }

    /**
     * Save new user
     *
     * @access  public
     * @return  Response
     */
    public function post_store()
    {
        $template = new \Model_Customer_Template();

        $val = Model_Customer_Template::validate();

        if ($val->run())
        {
            \DB::start_transaction();
            
            try
            {
                $template->set($val->validated());

                if ($template->save())
                {
                    \DB::commit_transaction();

                    Session::set_flash('success', 'テンプレートを追加しました');
                    Response::redirect('admin/templates');
                }
            }
            catch (Exception $e)
            {
                \DB::rollback_transaction();
                \Log::error($e);
            }
        }

        Session::set_flash('error', 'テンプレートを追加できませんでした');

        $this->template->title = 'New template';
        $this->template->content = View::forge('admin/templates/create', [
            'val' => $val,
            'template' => $template,
        ]);
    }

    /**
     * Edit
     *
     * @access  public
     * @return  Response
     */
    public function get_edit($id)
    {
        if (!$template = \Model_Customer_Template::find($id))
            throw new HttpNotFoundException;

        $this->template->title = 'Edit template';
        $this->template->content = View::forge('admin/templates/edit', [
            'val' => \Model_Customer_Template::validate(),
            'template' => $template,
        ]);
    }

    /**
     * Update
     *
     * @access  public
     * @return  Response
     */
    public function post_update($id)
    {
        if (!$template = \Model_Customer_Template::find($id))
            throw new HttpNotFoundException;

        $val = \Model_Customer_Template::validate();

        if ($val->run())
        {
            \DB::start_transaction();
            
            try
            {
                $template->set($val->validated());

                if ($template->save())
                {
                    \DB::commit_transaction();

                    Session::set_flash('success', 'テンプレートを更新しました');
                    Response::redirect('admin/templates');
                }
            }
            catch (Exception $e)
            {
                \DB::rollback_transaction();
                \Log::error($e);
            }
        }

        Session::set_flash('error', 'テンプレートを更新できませんでした');

        $this->template->title = 'Edit template';
        $this->template->content = View::forge('admin/templates/edit', [
            'val' => $val,
            'template' => $template,
        ]);
    }

    /**
     * Delete user
     *
     * @access  public
     * @return  Response
     */
    public function get_destroy($id)
    {
        // FIX ME (USE SOFT DELETE OR FLAG)
        if ($template = \Model_Customer_Template::find($id))
        {
            if ($template->delete())
                Session::set_flash('success', 'テンプレートを削除しました');
        }

        Response::redirect('admin/templates');
    }
}
