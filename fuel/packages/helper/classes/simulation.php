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

use Fuel\Core\Validation;
use JpPrefecture\JpPrefecture;

class Simulation
{
		protected $_val = null;

		private $region;
		
		private $basic_rate;
		private $prefecture_name;
		private $household_average_rate;

    private $city_average_commodity_charge    = 0;
		private $commodity_charge                 = 0;
    private $nationwide_reduction             = 0;
    private $new_enepi_reduction_average      = 0;

    private $monthly_estimated_price          = [];
    private $monthly_average_price            = [];
    private $new_enepi_reduction              = [];

		/**
		 * Prepare Helper for work
		 * @param Fuel\Core\Validation $val Recieve validation object
		 */
		public function __construct(Validation $val)
		{
				$this->_val = $val;

        $household                    = $val->validated('household');
        $month                        = $val->validated('month');
        $bill                         = $val->validated('bill');

				$city                         = \Model_LocalContentCity::find($val->validated('city_code'));
				$prefecture                   = \Model_LocalContentPrefecture::find($city->prefecture_code);
				$this->region                 = \Model_Region::find($city->city_code);
				$this->prefecture_name        = JpPrefecture::findByCode($city->prefecture_code)->nameKanji;

        $annual_average               = $prefecture->annual_average;
        $sum = [];

				$this->basic_rate             = (int) $city->basic_rate;
        $this->household_average_rate = (float) $prefecture[$month] / (float) $annual_average * (float) $prefecture[$household];

        if ($bill)
        {
            $city_average_commodity_charge = (int) $city->commodity_charge == 0 ? $prefecture->commodity_charge_criterion : $city->commodity_charge;
            $this->commodity_charge        = round(((int) $bill / 1.08 - $this->basic_rate) / $this->household_average_rate, 2);
        }
        else
        {
            $this->commodity_charge = (int) $city->commodity_charge == 0 ? $prefecture->commodity_charge_criterion : $city->commodity_charge;
            $this->estimated_bill   = ($this->basic_rate + $this->household_average_rate * $this->commodity_charge) * 1.08;
        }

        foreach (\Config::get('enepi.simulation.month.key_numeric') as $m)
        {
            $monthly_average_usage = $prefecture[$m];
            $sum[] = $monthly_average_usage;

            $monthly_estimated_usage         = $this->household_average_rate / $annual_average * $monthly_average_usage;
            $this->monthly_estimated_price[] = $monthly_estimated_usage * $this->commodity_charge + $this->basic_rate;
            $this->monthly_average_price[]   = (int) $city->commodity_charge == 0 ? $this->basic_rate + $prefecture->commodity_charge_criterion * $monthly_estimated_usage : $this->basic_rate + $city->commodity_charge * $monthly_estimated_usage;
        }

        $pref = \Arr::filter_recursive(\Arr::pluck(\Model_LocalContentPrefecture::find('all'), 'average_reduction_rate'), function($item){ return $item !== '0'; });
        $this->nationwide_reduction = round(array_sum($pref) / count($pref), 2);

        $usage_sum = array_sum($sum);

        $reduction = (int) $prefecture->average_reduction_rate == 0 ? $this->nationwide_reduction : (int) $prefecture->average_reduction_rate;

        foreach (\Config::get('enepi.simulation.month.key_numeric') as $m)
        {
            $this->new_enepi_reduction[] = round($reduction / $usage_sum * $prefecture[$m], 0);
        }

        $this->new_enepi_reduction_average = round(array_sum($this->new_enepi_reduction) / 12, 0);
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
				return $this->household_average_rate;
		}

		public function getCityAverageCommodityCharge()
		{
				return $this->city_average_commodity_charge;
		}

		public function getCommodityCharge()
		{
				return $this->commodity_charge;
		}

		public function getNationwideReduction()
		{
				return $this->nationwide_reduction;
		}

		public function getNewEnepiReductionAverage()
		{
				return $this->new_enepi_reduction_average;
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

		public function getMonthlyEstimatedPriceAverage()
		{
				return round(array_sum($this->monthly_estimated_price) / 12, 2);
		}

		public function getMonthlyAveragePriceAverage()
		{
				return round(array_sum($this->monthly_average_price) / 12, 2);
		}
}
