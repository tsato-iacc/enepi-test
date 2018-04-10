<?php
/**
 * Helper classes
 *
 * @package    Helper
 * @version    1.0
 * @author     Zazimko Alexey
 * @license    MIT License
 */

namespace Helper;

use JpPrefecture\JpPrefecture;

class Simulation
{
		private $region;
		
		private $basic_rate;
		private $prefecture_name;
		private $household_average_rate;

    private $estimated_bill                   = 0;
    private $city_average_commodity_charge    = 0;
		private $commodity_charge                 = 0;
    private $nationwide_reduction             = 0;
    private $new_enepi_reduction_average      = 0;
    private $average_reduction_rate           = 0;

    private $monthly_estimated_price          = [];
    private $monthly_average_price            = [];
    private $new_enepi_reduction              = [];

		/**
		 * Prepare Helper for work
		 * @param Fuel\Core\Validation $val Recieve validation object
		 */
		public function __construct(\Validation $val)
		{
        $household                    = $val->validated('household');
        $month                        = $val->validated('month');
        $bill                         = $val->validated('bill');

				$city                         = \Model_Localcontent_City::find($val->validated('city_code'));
				$this->prefecture             = \Model_Localcontent_Prefecture::find($city->prefecture_code);
				$this->region                 = \Model_Region::find($city->city_code);
				$this->prefecture_name        = JpPrefecture::findByCode($city->prefecture_code)->nameKanji;
				
        $annual_average               = $this->prefecture->annual_average;
        $sum = [];

				$this->basic_rate             = (int) $city->basic_rate;
        $this->household_average_rate = $this->prefecture[$month] / $annual_average * $this->prefecture[$household];

        if ($bill)
        {
            $this->city_average_commodity_charge = (int) $city->commodity_charge == 0 ? (int) $this->prefecture->commodity_charge_criterion : (int) $city->commodity_charge;
            $this->commodity_charge              = ((int) $bill / \Config::get('enepi.taxes.jp_acquisition_tax') - $this->basic_rate) / $this->household_average_rate;
        }
        else
        {
            $this->commodity_charge = (int) $city->commodity_charge == 0 ? $this->prefecture->commodity_charge_criterion : $city->commodity_charge;
            $this->estimated_bill   = ($this->basic_rate + $this->household_average_rate * $this->commodity_charge) * \Config::get('enepi.taxes.jp_acquisition_tax');
        }

        foreach (\Config::get('enepi.simulation.month.key_numeric') as $m)
        {
            $monthly_average_usage = $this->prefecture[$m];
            $sum[]                 = $monthly_average_usage;

            $monthly_estimated_usage         = $this->household_average_rate / $annual_average * $monthly_average_usage;
            $this->monthly_estimated_price[] = round($monthly_estimated_usage * $this->commodity_charge + $this->basic_rate, 0);
            $this->monthly_average_price[]   = (int) $city->commodity_charge == 0 ? $this->basic_rate + $this->prefecture->commodity_charge_criterion * $monthly_estimated_usage : $this->basic_rate + $city->commodity_charge * $monthly_estimated_usage;
        }

        $pref = \Arr::filter_recursive(\Arr::pluck(\Model_Localcontent_Prefecture::find('all'), 'average_reduction_rate'), function($item){ return $item !== '0'; });
        $this->nationwide_reduction = array_sum($pref) / count($pref);

        $usage_sum = array_sum($sum);

        $reduction = (int) $this->prefecture->average_reduction_rate == 0 ? $this->nationwide_reduction : (int) $this->prefecture->average_reduction_rate;

        foreach (\Config::get('enepi.simulation.month.key_numeric') as $m)
        {
            $this->new_enepi_reduction[] = round($reduction / $usage_sum * $this->prefecture[$m], 0);
        }

        $this->new_enepi_reduction_average = array_sum($this->new_enepi_reduction) / 12;
		}

		public function getRegion()
		{
				return $this->region;
		}

		public function getPrefectureName()
		{
				return $this->prefecture_name;
		}

		public function getBasicRate()
		{
				return $this->basic_rate;
		}

		public function getHouseholdAverageRate()
		{
				return round($this->household_average_rate, 2);
		}

		public function getCityAverageCommodityCharge()
		{
				return round($this->city_average_commodity_charge, 0);
		}

		public function getEstimatedBill()
		{
				return round($this->estimated_bill, 0);
		}

		public function getCommodityCharge()
		{
				return round($this->commodity_charge, 0);
		}

		public function getNationwideReduction()
		{
				return round($this->nationwide_reduction, 2);
		}

		public function getNewEnepiReductionAverage()
		{
				return round($this->new_enepi_reduction_average, 0);
		}

		public function getNewEnepiReduction()
		{
				return $this->new_enepi_reduction;
		}

		public function getMonthlyEstimatedPrice()
		{
				return $this->monthly_estimated_price;
		}

		public function getMonthlyAveragePrice()
		{
				return $this->monthly_average_price;
		}

		public function getAverageReductionRate()
		{
				return $this->prefecture->average_reduction_rate;
		}

		public function getMonthlyEstimatedPriceAverage()
		{
				return round(array_sum($this->monthly_estimated_price) / 12, 0);
		}

		public function getMonthlyAveragePriceAverage()
		{
				return round(array_sum($this->monthly_average_price) / 12, 0);
		}

		public function getGoogleChartJsonData()
		{
				$data = [
						'cols' => [
								['id' => '','label' => '月','pattern' => '','type' => 'string'],
								['id' => '','label' => '地域平均','pattern' => '','type' => 'number'],
								['id' => '','label' => 'エネピ平均削減額','pattern' => '','type' => 'number'],
						],
						'rows' => [],
				];

				foreach (\Config::get('enepi.simulation.month.key_numeric') as $k => $v)
				{
						$key = $k - 1;
						$data['rows'][] = ['c' => [['v' => "{$k}月"], ['v' => round($this->monthly_average_price[$key], 0)], ['v' => round($this->new_enepi_reduction[$key], 0)]]];
				}

				return json_encode($data, JSON_UNESCAPED_UNICODE);
		}

    /**
     * STATIC METHODS
     */
    public static function getBasicPrice($pref_code)
    {
        \Config::load('simulation', true);
        
        return \Config::get('simulation.basic_price.'.$pref_code, \Config::get('simulation.basic_price_default'));
    }

    public static function getUsedAmount($pref_code)
    {
        \Config::load('simulation', true);
        
        return \Config::get('simulation.used_amount.'.$pref_code, \Config::get('simulation.used_amount_default'));
    }
}
