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

            $result = $this->article_titles();
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
        $category = null;

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
            'category' => $category,
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

        $region_count = 47;
        $prefecture_KanjiAndCode   = JpPrefecture::allKanjiAndCode();
        $average                   = $this->prefecture_average();
        $around_articles           = $this->around_articles(   $prefecture_KanjiAndCode,
                                                               $code,
                                                               $region_count);
        $prefecture_kanji          = $this->prefecture_kanji(  $prefecture_KanjiAndCode,
                                                               $prefecture_data['id']);

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('local_contents'), 'name' => '都道府県料金一覧ページ'],
            ['url' => \Uri::create('local_contents/'.$code), 'name' => $prefecture_kanji[key($prefecture_kanji)].'プロパンガス(LPガス)の平均利用額はココでチェック!'],
        ];

        $this->template->title = '【'.$prefecture_kanji[key($prefecture_kanji)].'】'.'プロパンガス(LPガス)料金の適正価格と相場！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/prefecture', [
            'breadcrumb' => $breadcrumb,
            'result' => $result,
            'prefecture_data' => $prefecture_data,
            'region' => $region,
            'average_basic_rate' => $average['average_basic_rate'],
            'average_commodity_charge_criterion' => $average['average_commodity_charge_criterion'],
            'prefecture_kanji' => $prefecture_kanji,
            'reviews' => $reviews,
            'code' => $code,
            'prefecture_prev' => $around_articles['prefecture_prev'],
            'prefecture_next' => $around_articles['prefecture_next'],
            'region_count' => $region_count,
            'category' => 'prefecture'
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

        $city_data = \Model_LocalContentCity::find('first', [
            'where' => [
                ['id', $code],
            ]
        ]);

        $prefecture_data = \Model_LocalContentPrefecture::find('first', [
            'where' => [
                ['prefecture_code', $city_data->prefecture_code],
            ]
        ]);

        $region = \Model_Region::find('all', [
            'where' => [
                ['prefecture_code', $city_data->prefecture_code],
            ]
        ]);

        $reviews = array();
        $reviews = \Model_Review::find('all', [
            'where' => [
                ['city_code', $code],
            ]
        ]);

        $city_KanjiAndCode = [];
        $region_around_articles = \Model_Region::find('all', []);
        foreach($region_around_articles as $r){
            $city_KanjiAndCode[$r['id']] =  $r['city_name'];
        }

        $region_count = \Model_Region::count();
        $prefecture_KanjiAndCode   = JpPrefecture::allKanjiAndCode();
        $average                   = $this->prefecture_average();
        $around_articles           = $this->around_articles(   $city_KanjiAndCode,
                                                               $city_data->id,
                                                               $region_count);
        $prefecture_kanji          = $this->prefecture_kanji(  $prefecture_KanjiAndCode,
                                                               $city_data['prefecture_code']);

        $breadcrumb = [
            ['url' => \Uri::create('categories/lpgas'), 'name' => 'LPガス/プロパンガス'],
            ['url' => \Uri::create('local_contents'), 'name' => '都道府県料金一覧ページ'],
            ['url' => \Uri::create('local_contents/'.$code), 'name' => $prefecture_kanji[key($prefecture_kanji)].'プロパンガス(LPガス)の平均利用額はココでチェック!'],
            ['url' => \Uri::create('local_contents/city_show/'.$code), 'name' => $prefecture_kanji[key($prefecture_kanji)].$city_data->region->city_name.'プロパンガス(LPガス)の平均利用額はココでチェック!'],
        ];


        $this->template->title = '【'.$prefecture_kanji[key($prefecture_kanji)].$city_data->region->city_name.'】'.'プロパンガス(LPガス)料金の適正価格と相場！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/localContents/city', [
            'breadcrumb' => $breadcrumb,
            'reviews' => $reviews,
            'code' => $code,
            'result' => $result,
            'city_data' => $city_data,
            'prefecture_data' => $prefecture_data,
            'prefecture_kanji' => $prefecture_kanji,
            'region' => $region,
            'average_basic_rate' => $average['average_basic_rate'],
            'average_commodity_charge_criterion' => $average['average_commodity_charge_criterion'],
            'prefecture_prev' => $around_articles['prefecture_prev'],
            'prefecture_next' => $around_articles['prefecture_next'],
            'region_count' => $region_count,
            'category' => 'city'
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

    private function prefecture_average(){
        $average_basic_rate = 0;
        $average_commodity_charge_criterion = 0;
        $prefecture_average = \Model_LocalContentPrefecture::find('all', []);

        foreach($prefecture_average as $pa){
            $average_basic_rate += intval($pa['basic_rate']);
            $average_commodity_charge_criterion += intval($pa['commodity_charge_criterion']);
        }
        return $average = array('average_basic_rate' => round($average_basic_rate/47), 'average_commodity_charge_criterion' => round($average_commodity_charge_criterion/47));
    }

    private function prefecture_kanji($prefecture_KanjiAndCode, $prefecture_code){
        $prefecture_kanji = array();

        foreach ($prefecture_KanjiAndCode as $key => $value){
            if($key == $prefecture_code){
                $prefecture_kanji = array($key => $value);
            }
        }
        return $prefecture_kanji;
    }

    private function around_articles($prefecture_KanjiAndCode, $code, $max_count){
        if($code != 1){
            foreach ($prefecture_KanjiAndCode as $key => $value){
                if($key == $code-1){
                    $prefecture_prev = array($key => $value);
                }
            }
        }else{
            $prefecture_prev = null;
        }

        if($code != $max_count){
            foreach ($prefecture_KanjiAndCode as $key => $value){
                if($key == $code+1){
                    $prefecture_next = array($key => $value);
                }
            }
        }else{
            $prefecture_next = null;
        }

        return $around_articles = array('prefecture_prev' => $prefecture_prev, 'prefecture_next' => $prefecture_next);
    }
}
