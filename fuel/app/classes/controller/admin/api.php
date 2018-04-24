<?php

class Controller_Admin_Api extends Controller_Rest
{
    const PER_PAGE = 10;

    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        if (!\Input::is_ajax())
          throw new HttpNotFoundException;
    }

    public function get_contact_cancel_reasons()
    {
        $result = [];

        if ($group = \Input::get('group'))
        {
            $result = \Helper\CancelReasons::getReasonsByGroup($group);
        }
        
        $this->response(['result' => $result]);
    }

    public function get_cities_by_prefecture_code()
    {
        $response = [];
        $errors = [];

        $code = \Input::get('prefecture_code');

        $result = \DB::select('city_name')->from('zip_codes')->where('prefecture_code', $code)->group_by('city_name')->order_by('id', 'asc')->execute()->as_array();

        if ($result)
        {
            $response['result']['cities'] = $result;
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }

    public function get_city_zip_codes()
    {
        $response = [];
        $result = [];
        $errors = [];

        $prefecture_code = \Input::get('prefecture_code');
        $city_name = \Input::get('city_name');

        $zip_codes = \Model_ZipCode::find('all', [
            'where' => [
                ['prefecture_code', $prefecture_code],
                ['city_name', $city_name],
            ],
            'order_by' => [
                'zip_code' => 'asc'
            ]
        ]);

        if ($zip_codes)
        {
            foreach ($zip_codes as $zip)
            {
              $result['zip_codes'][] = "{$zip->zip_code} (".$zip->getAddress().")";
            }

            $response['result'] = $result;
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }

    public function get_templates()
    {
        $response = [];
        $result = [];
        $errors = [];

        $template_id = \Input::get('template_id');

        $template = \Model_Template::find($template_id);

        if ($template)
        {
            $result['template_subject'] = $template->subject;
            $result['template_body'] = $template->body;
            $response['result'] = $result;
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }

    public function post_templates()
    {
        $response = [];
        $result = [];
        $errors = [];

        $template_subject = \Input::post('template_subject');
        $template_body = \Input::post('template_body');
        $contact_id = \Input::post('contact_id');

        $contact = \Model_Contact::find($contact_id);

        if ($contact_id && $contact && $template_subject && $template_body)
        {
            \Model_Template::generateTemplate($template_subject, $contact);
            \Model_Template::generateTemplate($template_body, $contact);

            $template_body = str_replace("\n", "\n<br>", $template_body);
            
            $result['template_body'] = $template_body;
            $result['template_subject'] = $template_subject;
            $response['result'] = $result;
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }

    public function post_templates_send()
    {
        $response = [];
        $errors = [];

        $template_subject = \Input::post('template_subject');
        $template_body = \Input::post('template_body');
        $contact_id = \Input::post('contact_id');

        $contact = \Model_Contact::find($contact_id);

        if ($contact_id && $contact && $template_subject && $template_body)
        {
            \Helper\Notifier::notifyCustomerByTemplate($contact, $template_subject, $template_body);
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
