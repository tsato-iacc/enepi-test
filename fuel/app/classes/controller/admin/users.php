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
class Controller_Admin_Users extends Controller_Admin
{
    /**
     * Show list of users
     *
     * @access  public
     * @return  Response
     */
    public function get_index()
    {
        $this->template->title = '管理者一覧';
        $this->template->content = View::forge('admin/users/index', [
            'users' => \Model_AdminUser::find('all'),
        ]);
    }

    /**
     * Create new user
     *
     * @access  public
     * @return  Response
     */
    public function get_create()
    {
        $this->template->title = 'New user';
        $this->template->content = View::forge('admin/users/create', [
            'val' => \Model_AdminUser::validate(),
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
        $val = Model_AdminUser::validate();

        if ($val->run())
        {
            $password = \Str::random('hexdec', 16);
            $auth = Eauth::instance('admin');

            \DB::start_transaction();
            try
            {
                $user_id = $auth->create_user($val->validated('email'), $password, 2);

                if ($user_id)
                {
                    $user = \Model_AdminUser::find($user_id);
                    \Helper\Notifier::notifyAdminPassword($user, $password);

                    \DB::commit_transaction();

                    Session::set_flash('success', '管理者を追加しました');
                    Response::redirect('admin/users');
                }
                
            }
            catch (Exception $e)
            {
                \DB::rollback_transaction();
                \Log::error($e);
            }
        }

        Session::set_flash('error', '管理者を追加できませんでした');

        $this->template->title = 'New user';
        $this->template->content = View::forge('admin/users/create', [
            'val' => $val,
        ]);
    }

    /**
     * Delete user
     *
     * @access  public
     * @return  Response
     */
    public function get_delete($id)
    {
        // FIX ME (USE SOFT DELETE OR FLAG)
        if ($user = \Model_AdminUser::find($id))
        {
            // if ($user->delete())
                Session::set_flash('success', '管理者を削除しました');
        }

        Response::redirect('admin/users');
    }
}
