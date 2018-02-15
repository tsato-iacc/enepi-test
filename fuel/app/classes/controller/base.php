<?php

class Controller_Base extends Controller_Template
{
    protected $auth_user = null;

    public function before()
    {
        parent::before();
    }
}
