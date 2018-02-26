<?php

class Controller_Admin extends Controller_Base
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        if (Request::active()->controller !== 'Controller_Admin' or !in_array(Request::active()->action, ['login', 'logout']))
        {
            if (Eauth::check('admin'))
            {
                $user_id = Eauth::instance('admin')->get('id');
                $this->auth_user = \Model_AdminUser::find($user_id);
                \View::set_global('auth_user', $this->auth_user, false);
            }
            else
            {
                Response::redirect('admin/login');
            }
        }
    }

    public function action_login()
    {
        Eauth::check('admin') and Response::redirect('admin/estimates');

        $this->template = \View::forge('auth/template');

        $val = Validation::forge();

        if (Input::method() == 'POST')
        {
            $val->add_field('email', 'email', 'required|valid_email');
            $val->add_field('password', 'password', 'required');

            if ($val->run())
            {
                $auth = Eauth::instance('admin');

                // check the credentials. This assumes that you have the previous table created
                if ($auth->login(\Input::param('email'), \Input::param('password')))
                {
                    if (\Input::param('remember', false))
                    {
                        // create the remember-me cookie
                        \Eauth::remember_me();
                    }
                    else
                    {
                        // delete the remember-me cookie if present
                        \Eauth::dont_remember_me();
                    }

                    Response::redirect('admin/estimates');
                }
                else
                {
                    $this->template->set_global('login_error', 'Fail');
                }
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
        $auth = Eauth::instance('admin');
        $auth->logout();
        
        Response::redirect('admin/login');
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
