<?php

use Cms\Exceptions\ClientException;
use Cms\Client;
use JpPrefecture\JpPrefecture;

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
        try
        {
            $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

            $condition = [
                'page'          => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per'           => \Config::get('enepi.articles.popular.per_page'),
                'sort'          => \Config::get('enepi.articles.popular.sort'),
            ];

            $popular = $client->getArticles($condition);
            $result = $this->article_titles();
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());
            throw new HttpNotFoundException();
        }

        $code = null;
        $prefecture_prev = null;
        $prefecture_next = null;

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
            'popular' => $popular,
            'result' => $result,
            'code' => $code,
            'prefecture_prev' => $prefecture_prev,
            'prefecture_next' => $prefecture_next,
        ]);
//        $this->template->content -> set_global('local_contents_bottom_part',$popular);
    }

    /**
     * Show content by prefecture code
     *
     * @access  public
     * @return  Response
     */
    public function action_prefecture($code = null)
    {
        try
        {
            $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

            $condition = [
                'page'          => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per'           => \Config::get('enepi.articles.popular.per_page'),
                'sort'          => \Config::get('enepi.articles.popular.sort'),
            ];

            $popular = $client->getArticles($condition);
            $result = $this->article_titles();
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());
            throw new HttpNotFoundException();
        }

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $prefecture_data = \Model_LocalContentPrefecture::find('first', [
          'where' => [
            ['prefecture_code', $code],
          ]
        ]);

        $average_basic_rate = 0;
        $average_commodity_charge_criterion = 0;
        $prefecture_average = \Model_LocalContentPrefecture::find('all', []);

        foreach($prefecture_average as $pa){
            $average_basic_rate += intval($pa['basic_rate']);
            $average_commodity_charge_criterion += intval($pa['commodity_charge_criterion']);
        }
        $average_basic_rate = round($average_basic_rate/47);
        $average_commodity_charge_criterion = round($average_commodity_charge_criterion/47);



        $region = \Model_Region::find('all', [
            'where' => [
              ['prefecture_code', $code],
            ]
        ]);

        $reviews = array();
        $reviews = \Model_Review::find('all', [
            'where' => [
                ['prefecture_code', $code],
            ]
        ]);

        $prefecture_KanjiAndCode = JpPrefecture::allKanjiAndCode();
        $prefecture_kanji = array();
        foreach ($prefecture_KanjiAndCode as $key => $value){
            if($key == $prefecture_data['id']){
                $prefecture_kanji = array($key => $value);
            }
        }

        if($code != 1){
          foreach ($prefecture_KanjiAndCode as $key => $value){
              if($key == $prefecture_data['id']-1){
                  $prefecture_prev = array($key => $value);
              }
          }
        }else{
            $prefecture_prev = null;
        }

        if($code != 47){
          foreach ($prefecture_KanjiAndCode as $key => $value){
              if($key == $prefecture_data['id']+1){
                  $prefecture_next = array($key => $value);
              }
           }
        }else{
            $prefecture_next = null;
        }

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('local_contents'), 'name' => '都道府県料金一覧ページ'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => $prefecture_kanji[key($prefecture_kanji)].'プロパンガス(LPガス)の平均利用額はココでチェック!'],
        ];

        $this->template->title = 'プロパンガス(LPガス)料金の適正価格と相場！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/prefecture', [
            'breadcrumb' => $breadcrumb,
            'result' => $result,
            'prefecture_data' => $prefecture_data,
            'region' => $region,
            'average_basic_rate' => $average_basic_rate,
            'average_commodity_charge_criterion' => $average_commodity_charge_criterion,
            'prefecture_kanji' => $prefecture_kanji,
            'reviews' => $reviews,
            'code' => $code,
            'prefecture_prev' => $prefecture_prev,
            'prefecture_next' => $prefecture_next,
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
        try
        {
            $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

            $condition = [
                'page'          => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per'           => \Config::get('enepi.articles.popular.per_page'),
                'sort'          => \Config::get('enepi.articles.popular.sort'),
            ];

            $popular = $client->getArticles($condition);
            $result = $this->article_titles();
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());
            throw new HttpNotFoundException();
        }

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('simple_simulations/new'), 'name' => '料金シミュレーション'],
        ];

        $this->template->title = 'プロパンガス(LPガス)料金の適正価格と相場！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/city', [
            'breadcrumb' => $breadcrumb,
            'result' => $result,
        ]);
    }

    private function article_titles(){
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));
        $array = ['401', '402', '426'];
        $result = [];
        try
        {
            foreach($array as $arr){
                $condition = [
                    'increment_access_count' => false,
                ];
                $result[]= $client->getArticleById($arr, $condition);
            }
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());
            throw new HttpNotFoundException();
        }
        return $result;
    }
}
