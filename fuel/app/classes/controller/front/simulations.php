<?php

use Helper\Simulation;

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Simulations extends Controller_Front
{
    /**
     * Show simple simulation form
     *
     * @access  public
     * @return  Response
     */
    public function get_index()
    {
        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス料金シミュレーションは、使用量やガス料金などを入力するだけで切り替え後の料金イメージをラクラク算出できます！さらにガス代が高くてお悩みのお客様には今よりおトクになるガス会社をネット上で無料ご提案します。'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $month_selected = strtolower(date('F', mktime(0, 0, 0, date('n') - 1, 10)));

        $this->template->title = '簡単入力！プロパンガス料金シミュレーション';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/simulations/index', [
            'breadcrumb' => $breadcrumb,
            'month_selected' => $month_selected,
            'prefecture_code' => \Input::get('prefecture_code', null),
        ]);
    }

    /**
     * Show simple simulation result
     *
     * @access  public
     * @return  Response
     */
    public function post_index()
    {
        $val = \Model_Simulation::validate();

        if (!$val->run())
            return Response::redirect('simple_simulations/new');

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
                'ip'              => \Input::ip(),
            ]);

            if (!$simulation->save())
                return Response::redirect('simple_simulations/new');
        }

        $meta = [
            ['name' => 'viewport', 'content' => 'content="width=device-width, initial-scale=1"'],
            ['name' => 'fb:app_id', 'content' => '590655641075329'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
            ['url' => '', 'name' => 'シミュレーション結果'],
        ];

        $this->template->title = 'プロパンガス料金シミュレーション 結果';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/simulations/show', [
            'breadcrumb'                    => $breadcrumb,
            'zip'                           => $zip,
            'household'                     => \Config::get('enepi.household.key_string_numeric.'.$household),
            'month'                         => $month,
            'bill'                          => $bill,
            'city_name'                     => $region->city_name,
            'prefecture_name'               => $simulationHelper->getPrefectureName(),
            'household_average_rate'        => number_format($simulationHelper->getHouseholdAverageRate(), 1),
            'basic_rate'                    => number_format($simulationHelper->getBasicRate()),
            'commodity_charge'              => number_format($simulationHelper->getCommodityCharge()),
            'city_average_commodity_charge' => number_format($simulationHelper->getCityAverageCommodityCharge()),
            'estimated_bill'                => $simulationHelper->getEstimatedBill(),
            'average_reduction_rate'        => number_format($simulationHelper->getAverageReductionRate()),
            'nationwide_reduction'          => number_format($simulationHelper->getNationwideReduction()),
            'monthly_average_price'         => $simulationHelper->getMonthlyAveragePrice(),
            'new_enepi_reduction'           => $simulationHelper->getNewEnepiReduction(),
            'new_enepi_reduction_average'   => $simulationHelper->getNewEnepiReductionAverage(),
            'monthly_average_price_average' => $simulationHelper->getMonthlyAveragePriceAverage(),
            'google_chart_json_data'        => $simulationHelper->getGoogleChartJsonData(),
        ]);
    }
}
