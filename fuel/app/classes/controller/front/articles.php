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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Articles extends Controller_Front
{
    /**
     * Show list of articles
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $NUM = 30;

            // 実際の記事の厳選
            $condition = [
                'page' => \Input::get('page', '1'),
                'per' => $NUM,
            ];

            $articles = $client->getArticles($condition);

            // ページリンクの生成
            \Pagination::forge('default', [
                'total_items' => $articles['total_count'],
                'num_links' => floor($articles['total_count']/$NUM)+1,
                'per_page' => $NUM,
                'pagination_url' => \Uri::current(),
                'uri_segment' => 'page',
            ]);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        $meta = [];

        $breadcrumb = [
            ['url' => \Uri::create('articles'), 'name' => '記事一覧'],
        ];

        // $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/articles/index', [
            'breadcrumb' => $breadcrumb,
            'articles' => $articles,

            // 'mini_nav' => true,
        ]);

    }

    /**
     * Show article by id
     *
     * @access  public
     * @return  Response
     */
    public function action_show($id)
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $condition = [
                'increment_access_count' => \Fuel::$env == \Fuel::PRODUCTION || \Input::get('increment_access_count', false),
            ];

            $article = $client->getArticleById($id, $condition);

            if ($article['redirect_url'])
                return Response::redirect($article['redirect_url'], 'location', 301);

            if (count($article['categories']))
            {
                $category = explode('/', $article['categories'][0]['path_name_prog'])[0];

                if ($category == 'lpgas_before')
                    $category = str_replace('_before', '', $category);

                $pickup = $client->getArticlesByModule('pickup_' . $category);
            }
            else
            {
                $pickup = $client->getArticlesByModule('pickup');
            }

        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        $meta = [
            ['name' => 'description',     'content' => $article['meta_description']],
            ['name' => 'keywords',        'content' => $article['meta_keywords']],
            ['name' => 'ogp:type',        'content' => 'article'],
            ['name' => 'ogp:title',       'content' => $article['meta_title']],
            ['name' => 'ogp:description', 'content' => $article['meta_description']],
            ['name' => 'ogp:image',       'content' => $article['thumbnail_url']],
            ['name' => 'ogp:url',         'content' => \Uri::create("articles/{$article['id']}")],
        ];

        $breadcrumb = [];
        $url = "";

        foreach ($article['categories'][0]['full'] as $v)
        {
            $url .= "/{$v['name_prog']}";
            $breadcrumb[] = ['url' => \Uri::create("categories{$url}"), 'name' => $v['name']];
        }

        $breadcrumb[] = ['url' => \Uri::create("categories{$url}/articles"), 'name' => $article['categories'][0]['name'] . "の記事一覧"];
        $breadcrumb[] = ['url' => \Uri::create("articles/{$id}"), 'name' => $article['title']];

        $this->template->title = $article['title'];
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/articles/show', [
            'breadcrumb' => $breadcrumb,
            'article' => $article,
            'pickup' => $pickup,
        ], false);
    }
}
