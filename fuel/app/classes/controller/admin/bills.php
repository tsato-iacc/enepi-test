<?php
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
 * The Admin Bills Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Bills extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $from = \Helper\TimezoneConverter::convertFromStringToUTC(date('Y-m-01', strtotime(\Date::time()->format('mysql_date_time'))));
        $to = \Helper\TimezoneConverter::convertFromStringToUTC(date('Y-m-t', strtotime(\Date::time()->format('mysql_date_time'))));

        $result = \DB::select(\DB::expr('SUM(contracted_commission) as contracted_commission'))->from('lpgas_estimates')->where('status', 4)->and_where('status_updated_at', '>=', $from)->and_where('status_updated_at', '<=', $to)->execute()->as_array();        
        $result = reset($result);
        $commission = $result['contracted_commission'] ? $result['contracted_commission'] : 0;

        $this->template->title = 'Bills';
        $this->template->content = View::forge('admin/bills/index', [
            'companies' => \Model_Company::find('all', ['related' => ['partner_company']]),
            'from' => $from,
            'to' => $to,
            'commission' => $commission,
        ]);
    }
}
