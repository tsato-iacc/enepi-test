<?php

class Controller_Partner extends Controller_Base
{
    public $template = 'partner/template';

    // FIX ME Set real id
    protected $partner_id = 4;

    public function before()
    {
        parent::before();
        
        if (Request::active()->controller !== 'Controller_Partner' or !in_array(Request::active()->action, ['login', 'logout']))
        {
            // if (Auth::check())
            if (true)
            {
                $this->auth_user = \Model_Partner_Company::find($this->partner_id);
                \View::set_global('auth_user', $this->auth_user, false);
                // check permission
                // if (!Auth::member(\Config::get('carme.groups.superadmin')) && !$access)
                //     throw new HttpNotFoundException;
            }
            else
            {
                Response::redirect('partner/login');
            }
        }
    }

    public function action_login()
    {
        $this->template = \View::forge('auth/template');
        // Already logged in
        // Auth::check() and Response::redirect('admin');

        $val = Validation::forge();

        if (Input::method() == 'POST')
        {
            $val->add_field('email', 'email', 'required|valid_email');
            $val->add_field('password', 'password', 'required');

            if ($val->run())
            {
                // $auth = Auth::instance();

                // // check the credentials. This assumes that you have the previous table created
                // if (Auth::check() or $auth->login($val->validated('email'), $val->validated('password')))
                // {
                //     // credentials ok, go right in
                //     $current_user = Model\Auth_User::find_by_username(Auth::get_screen_name());

                //     Session::set_flash('success', e('Welcome, ' . $current_user->username));
                //     Response::redirect('admin/article');
                // }
                // else
                // {
                //     $this->template->set_global('login_error', 'Fail');
                // }
            }
        }

        $this->template->title = 'sign in';
        $this->template->content = View::forge('auth/login', ['val' => $val], false);
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
