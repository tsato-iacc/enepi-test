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

    public function post_city_zip_codes()
    {
        $response = [];
        $result = [];
        $errors = [];

        $office_id = \Input::post('office_id');
        $geocode = \Model_Company_Geocode::find($office_id);
        $prefecture_code = \Input::post('prefecture_code');
        $city_name = \Input::post('city_name');

        $zip_codes = \Model_ZipCode::find('all', [
            'where' => [
                ['prefecture_code', $prefecture_code],
                ['city_name', $city_name],
            ]
        ]);

        if ($geocode && $zip_codes)
        {
            $exists_zips = \Arr::pluck(\DB::select_array(['zip_code'])->where('company_geocode_id', $office_id)->from('lpgas_company_geocode_zip_codes')->execute(), 'zip_code');

            \DB::start_transaction();
    
            try
            {
                foreach ($zip_codes as $zip)
                {
                    if (in_array($zip->zip_code, $exists_zips))
                        continue;

                    $record = new \Model_Company_GeocodeZipCode([
                        'company_geocode_id' => $geocode->id,
                        'zip_code' => $zip->zip_code,
                        'notes' => $zip->getAddress(),
                    ]);

                    $record->save();
                }

                \DB::commit_transaction();
                $response['result'] = 'success';
            }
            catch (\Exception $e)
            {
                \DB::rollback_transaction();
                $errors[] = 'Saving error';
                $response['errors'] = $errors;
            }
        }
        else
        {
            $errors[] = 'Invalid input';
            $response['errors'] = $errors;
        }

        $this->response($response);
    }
}
