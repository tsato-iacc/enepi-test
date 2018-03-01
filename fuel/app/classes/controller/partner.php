<?php

class Controller_Partner extends Controller_Base
{
    public $template = 'partner/template';

    public function before()
    {
        parent::before();
        
        if (Request::active()->controller !== 'Controller_Partner' or !in_array(Request::active()->action, ['login', 'logout']))
        {
            if (Eauth::check('partner'))
            {
                $user_id = Eauth::instance('partner')->get('id');
                $this->auth_user = \Model_Partner_Company::find($user_id);
                \View::set_global('auth_user', $this->auth_user, false);
            }
            else
            {
                Response::redirect('partner/login');
            }
        }
    }

    public function action_login()
    {
        Eauth::check('partner') and Response::redirect('partner/estimates');

        $this->template = \View::forge('auth/template');

        $val = Validation::forge();

        if (Input::method() == 'POST')
        {
            $val->add_field('login_id', 'login_id', 'required');
            $val->add_field('email', 'email', 'required|valid_email');
            $val->add_field('password', 'password', 'required');

            if ($val->run())
            {
                $auth = Eauth::instance('partner');

                // check the credentials. This assumes that you have the previous table created
                if ($auth->login(\Input::param('email'), \Input::param('password'), \Input::param('login_id')))
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

                    Response::redirect('partner/estimates');
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
        $auth = Eauth::instance('partner');
        $auth->logout();
        
        Response::redirect('partner/login');
    }

    /**
     * The index action.
     *
     * @access  public
     * @return  void
     */
    public function action_redirect()
    {
        Response::redirect('partner/estimates');
    }
}
