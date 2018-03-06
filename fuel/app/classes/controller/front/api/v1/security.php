<?php

class Controller_Front_Api_v1_Security extends Controller_Rest
{
    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        // if (!\Input::is_ajax())
        //   throw new \HttpNotFoundException;
    }

    public function get_key()
    {
        $response = [
            'authenticity_token' => \Config::get('enepi.service.api_security_key')
        ];

        $this->response($response);
    }
}
