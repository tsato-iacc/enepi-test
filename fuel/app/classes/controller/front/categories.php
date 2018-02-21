<?php

use Cms\Client;
use Cms\Exceptions\ClientException;

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
 * The Categories Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Categories extends Controller_Front
{
    /**
     * Show index of Category
     *
     * @access  public
     * @return  Response
     */
    public function action_index($category, $subOne = null, $subTwo = null, $subThree = null)
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            // Combine subcategory's path
            $category_path = rtrim(implode('/', [$category, $subOne, $subTwo, $subThree]), '/');

            $category_header = $client->getCategory($category_path);

            if ($category_header['article']['redirect_url'])
                return Response::redirect($category_header['article']['redirect_url'], 'location', 301);

                $category_content = $client->getCategoryContent($category_path, ['depth' => 1]);

                $condition = [
                    'page' => 1,
                    'per' => \Config::get('enepi.category.index.per_page'),
                ];


                foreach ($category_content as $k => $v)
                {
                    $condition['category_path'] = $v['path_name_prog'];
                    $category_content[$k]['content'] = $client->getArticles($condition);
                }

                $condition['category_path'] = $category_path;
                $articles = $client->getArticles($condition);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        $arr = $category_header["full"];
        $breadcrumb = array();
        $i = 0;
        foreach($arr as $ar){
            if($i == 0){
                $breadcrumb_Individual = [
                    ['url' => \Uri::create('/categories/'.$ar["name_prog"]), 'name' => $ar["name"]],
                ];
            }else{
                $breadcrumb_Individual = [
                    ['url' => \Uri::create($breadcrumb[$i-1]["url"].'/'.$ar["name_prog"]), 'name' => $ar["name"]],
                ];
            }
            $i++;
            $breadcrumb = array_merge($breadcrumb, $breadcrumb_Individual);
        }

        // FIX ME!
        $meta = [
            ['name' => 'description',       'content' => $category_header['article']['meta_description']],
            ['name' => 'keywords',        'content' => $category_header['article']['meta_keywords']],
            ['name' => 'og:type',           'content' => 'article'],
            ['name' => 'og:title',          'content' => $category_header['article']['title']],
            ['name' => 'og:description',    'content' => $category_header['article']['description']],
            ['name' => 'og:image',         'content' => $category_header['article']['thumbnail_url']],
            ['name' => 'og:url',           'content' => "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]],
        ];

        // FIX ME!
        $this->template->title = 'プロパンガス(LPガス)に関する記事一覧';
        $this->template->meta = $meta;

        $this->template->content = View::forge('front/categories/index', [
            'breadcrumb' => $breadcrumb,
            'category' => $category_header,
            'category_content' => $category_content,
            'articles' => $articles,
            // 'mini_nav' => true,
        ]);
    }



    /**
     * Show Category's Articles
     *
     * @access  public
     * @return  Response
     */
    public function action_articles($category, $subOne = null, $subTwo = null, $subThree = null)
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            // Combine subcategory's path
            $category_path = rtrim(implode('/', [$category, $subOne, $subTwo, $subThree]), '/');

            $category_header = $client->getCategory($category_path);
            $category_content = $client->getCategoryContent($category_path, ['depth' => 1]);

            $condition = [
                'page' => \Input::get('page', '1'),
                'per' => \Config::get('enepi.category.articles.per_page'),
                'category_path' => $category_path,
            ];

            $articles = $client->getArticles($condition);

            \Pagination::forge('articles_page', [
                'total_items' => $articles['total_count'],
                'per_page' => $condition['per'],
                'pagination_url' => \Uri::current(),
                'uri_segment' => 'page',
            ]);

            $condition['category_path'] = \Config::get('enepi.cms.category_path.citygas');
            $condition['per'] = \Config::get('enepi.category.popular.per_page');
            $condition['sort'] = \Config::get('enepi.category.popular.sort');
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        $arr = $category_header["full"];
        $breadcrumb = array();
        $i = 0;
        foreach($arr as $ar){
            if($i == 0){
                $breadcrumb_Individual = [
                    ['url' => \Uri::create('/categories/'.$ar["name_prog"]), 'name' => $ar["name"]],
                ];
            }else{
                $breadcrumb_Individual = [
                    ['url' => \Uri::create($breadcrumb[$i-1]["url"].'/'.$ar["name_prog"]), 'name' => $ar["name"]],
                ];
            }
            $i++;
            $breadcrumb = array_merge($breadcrumb, $breadcrumb_Individual);
        }
        $breadcrumb_Individual = [
            ['url' => \Uri::create('/categories/'.$category_header["path_name_prog"].'/articles'), 'name' => $category_header["name"]."の記事一覧"],
        ];
        $breadcrumb = array_merge($breadcrumb, $breadcrumb_Individual);

        $meta = [];

        // FIX ME!
        $this->template->title = 'エネピ';
        $this->template->meta = $meta;

        $this->template->content = View::forge('front/categories/articles', [
            'breadcrumb' => $breadcrumb,
            'category' => $category_header,
            'category_content' => $category_content,
            'articles' => $articles,
            // 'mini_nav' => true,
        ]);
    }
}
