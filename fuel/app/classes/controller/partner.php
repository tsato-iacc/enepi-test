<?php

class Controller_Partner extends Controller_Base
{
    public $template = 'partner/template';

    public function action_login()
    {
        // Already logged in
        // Auth::check() and Response::redirect('admin');

        $val = Validation::forge();

        // if (Input::method() == 'POST')
        // {
        //     $val->add('email', 'Email or Username')
        //         ->add_rule('required');
        //     $val->add('password', 'Password')
        //         ->add_rule('required');

        //     if ($val->run())
        //     {
        //         $auth = Auth::instance();

        //         // check the credentials. This assumes that you have the previous table created
        //         if (Auth::check() or $auth->login($val->validated('email'), $val->validated('password')))
        //         {
        //             // credentials ok, go right in
        //             $current_user = Model\Auth_User::find_by_username(Auth::get_screen_name());

        //             Session::set_flash('success', e('Welcome, ' . $current_user->username));
        //             Response::redirect('admin/article');
        //         }
        //         else
        //         {
        //             $this->template->set_global('login_error', 'Fail');
        //         }
        //     }
        // }

        $this->template->title = 'Login';
        $this->template->content = View::forge('partner/login', ['val' => $val], false);
    }

    /**
     * The logout action.
     *
     * @access  public
     * @return  void
     */
    public function action_logout()
    {
        // Auth::logout();
        Response::redirect('/');
    }

    /**
     * The index action.
     *
     * @access  public
     * @return  void
     */
    // public function action_index()
    // {
    //     $this->template->title = 'Dashboard';
    //     $this->template->content = View::forge('admin/index');
    // }
}
