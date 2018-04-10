<?php

use JpPrefecture\Config;

class Controller_Front_Api_v1_Simulation extends Controller_Rest
{
    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        // if (!\Input::is_ajax())
        //   throw new \HttpNotFoundException;
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

    public function get_index()
    {
        $response = [];
        $result = [];
        $errors = [];

        $val = \Model_Simulation::validate();

        if ($val->run(\Input::get()))
        {
            $household              = $val->validated('household');
            $month                  = $val->validated('month');
            $bill                   = $val->validated('bill');

            $simulationHelper       = new Simulation($val);
            $region                 = $simulationHelper->getRegion();

            $zip = \Model_ZipCode::find('first', [
                'where' => [
                    ['prefecture_code', $region->prefecture_code],
                    ['city_name', 'LIKE', "{$region->city_name}%"],
                ],
                'order_by' => [
                    'id' => 'asc'
                ],
            ]);

            if (!$zip)
            {
                $zip = new \Model_ZipCode([
                    'zip_code' => '0000000',
                    'prefecture_code' => $region->prefecture_code,
                    'city_name' => $region->city_name,
                ]);
            }

            if ($bill)
            {
                $simulation = new Model_Simulation([
                    'prefecture_code' => $val->validated('prefecture_code'),
                    'city_code'       => $val->validated('city_code'),
                    'household'       => $val->validated('household'),
                    'amount_billed'   => $val->validated('bill'),
                    'month'           => date_parse($val->validated('month'))['month'],
                    'ip'              => \Input::real_ip(),
                    'type'            => 'api',
                ]);

                if (!$simulation->save())
                {
                    \Log::error('Simulation API: Could not save model');
                }
            }

            $response = [
                'status'                          => 'success',
                'bill'                            => $bill,
                'prefecture_name'                 => $simulationHelper->getPrefectureName(),
                'city_name'                       => $region->city_name,
                'household'                       => \Config::get('enepi.household.key_string_numeric.'.$household),
                'household_average_rate'          => $simulationHelper->getHouseholdAverageRate(),
                'commodity_charge'                => $simulationHelper->getCommodityCharge(),
                'city_average_commodity_charge'   => $simulationHelper->getCityAverageCommodityCharge(),
                'nationwide_reduction'            => $simulationHelper->getNationwideReduction(),
                'monthly_average_price'           => round($simulationHelper->getMonthlyAveragePrice()),
                'monthly_average_price_average'   => $simulationHelper->getMonthlyAveragePriceAverage(),
                'new_enepi_reduction'             => $simulationHelper->getNewEnepiReduction(),
                'new_enepi_reduction_average'     => $simulationHelper->getNewEnepiReductionAverage(),
                'chart'                           => $simulationHelper->getGoogleChartJsonData(),
                'monthly_estimated_price'         => $simulationHelper->getMonthlyEstimatedPrice(),
                'monthly_estimated_price_average' => $simulationHelper->getMonthlyEstimatedPriceAverage(),
                'estimated_bill'                  => $simulationHelper->getEstimatedBill(),
            ];
        }
        else
        {
            foreach ($val->error() as $err)
            {
                $errors[] = [$err->field->name => $err->get_message()];
            }

            $response['status'] = 'error';
            $response['errors'] = $errors;
        }

        $this->response(json_encode($response, JSON_UNESCAPED_UNICODE));
    }
}
