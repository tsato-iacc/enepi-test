<?php

class Controller_Front_Api_v1_Twillio extends Controller_Rest
{
    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        if (!\Input::is_ajax())
          throw new \HttpNotFoundException;
    }

    public function post_sms()
    {
        $response = [];
        $errors = [];

        $token = \Input::post('token');
        $contact_id = \Input::post('contact_id');

        if ($token && $contact_id)
        {
            $contact = \Model_Contact::find($contact_id);

            if ($contact && $contact->token == $token)
            {
                \Helper\Notifier::notifyCustomerPin($contact);
                $response['result'] = 'success';
            }
            else
            {
                $response['result'] = 'error';
                $errors['message'] = 'Access denied';
            }
        }
        else
        {
            $response['result'] = 'error';
            $errors['message'] = 'Invalid input';
        }

        $response['errors'] = $errors;

        $this->response($response);
    }
}
