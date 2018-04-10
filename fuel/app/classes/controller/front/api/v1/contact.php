<?php

use JpPrefecture\Config;

class Controller_Front_Api_v1_Contact extends Controller_Rest
{
    protected $rest_format = 'json';

    private $current_user = null;

    public function before()
    {
        parent::before();

        if (!\Input::is_ajax())
          throw new \HttpNotFoundException;
    }

    public function post_done_form()
    {
        // check for a valid CSRF token
        // if (!\Security::check_token())
        // {
        //     throw new \HttpNotFoundException;
        // }

        $response = [];
        $result = [];
        $errors = [];

        $id = str_replace('LPGAS-', '', \Input::post('conversion_id'));

        if ($contact = \Model_Contact::find($id))
        {
            $data = [
                'q_1' => \Input::post('q_1', '不明'),
                'q_2' => \Input::post('q_2', '不明'),
                'q_3' => \Input::post('q_3', '不明'),
            ];

            \Helper\Notifier::notifyAdminDoneForm($contact, $data);
            
            $response['result'] = 'success';
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }
}
