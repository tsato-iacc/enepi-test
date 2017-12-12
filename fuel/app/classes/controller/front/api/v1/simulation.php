<?php

use JpPrefecture\Config;

class Controller_Front_Api_v1_Simulation extends Controller_Rest
{
    protected $rest_format = 'json';

    private $current_user = null;

    public function before()
    {
        parent::before();

        if (!\Input::is_ajax())
          throw new \HttpNotFoundException;
    }

    public function get_cities()
    {
        $response = [];
        $result = [];
        $errors = [];

        $code = \Input::get('prefecture_code');

        if ($code && array_key_exists((int)$code, Config::CODES))
        {
            $cities = \Model_Region::find('all', [
                'where' => [
                    ['prefecture_code', $code]
                ]
            ]);

            foreach ($cities as $city)
            {
              $result['cities'][$city->id] = $city->city_name;
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
}
