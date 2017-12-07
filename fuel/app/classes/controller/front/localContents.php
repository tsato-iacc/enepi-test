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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_LocalContents extends Controller_Front
{
    /**
     * Show local content's index page
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $meta = [
            ['name' => 'description', 'content' => '全国のプロパンガス料金を知りたい方はこちらをチェック！お住まいの地域をクリックして頂くと、市区町村ごとの詳細なガス代を調べられます。プロパンガス(LPガス)は地域によって料金が異なるので、平均的なガス代を把握し、見直しに役立ててください。'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('local_contents'), 'name' => '都道府県料金一覧ページ'],
        ];

        $this->template->title = '全国のプロパンガス(LPガス)の平均利用額はココでチェック!';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/index', [
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * Show content by prefecture code
     *
     * @access  public
     * @return  Response
     */
    public function action_prefecture($code = null)
    {
        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('local_contents'), 'name' => '都道府県料金一覧ページ'],
            // ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/prefecture', [
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * Show content by city code
     *
     * @access  public
     * @return  Response
     */
    public function action_city($code = null)
    {
        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/city', [
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
