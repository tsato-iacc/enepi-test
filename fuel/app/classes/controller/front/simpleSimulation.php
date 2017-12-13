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
class Controller_Front_SimpleSimulation extends Controller_Front
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

        // FIX ME
        $month_selected = '10';

        $this->template->title = '簡単入力！プロパンガス料金シミュレーション';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/simpleSimulation/index', [
            'breadcrumb' => $breadcrumb,
            'month_selected' => $month_selected,
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
        $val = \Model_SimpleSimulation::validate();

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

        if ($bill)
        {
            $simulation = new Model_SimpleSimulation([
                'prefecture_code' => $val->validated('prefecture_code'),
                'city_code'       => $val->validated('city_code'),
                'household'       => $val->validated('household'),
                'amount_billed'   => $val->validated('bill'),
                'month'           => $val->validated('month'),
            ]);

            if (!$simulation->save())
                return Response::redirect('simple_simulations/new');
        }

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス料金のシミュレーション結果ページです。ご入力頂いた内容を元に、今のガス代がどれくらい安くなるか算出しています。ガスの見直しにお役立てください。'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $this->template->title = 'プロパンガス料金シミュレーション 結果';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/simpleSimulation/show', [
            'breadcrumb'                    => $breadcrumb,
            'zip'                           => $zip,
            'household'                     => $household,
            'month'                         => $month,
            'bill'                          => $bill,
            'city_name'                     => $region->city_name,
            'prefecture_name'               => $simulationHelper->getPrefectureName(),
            'household_average_rate'        => $simulationHelper->getHouseholdAverageRate(),
            'basic_rate'                    => number_format($simulationHelper->getBasicRate()),
            'commodity_charge'              => number_format($simulationHelper->getCommodityCharge()),
            'city_average_commodity_charge' => number_format($simulationHelper->getCityAverageCommodityCharge()),
            'estimated_bill'                => number_format($simulationHelper->getEstimatedBill()),
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
