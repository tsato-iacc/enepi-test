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
            $condition = [
                'page' => \Input::get('page', '1'),
                'per' => \Config::get('enepi.articles.index.per_page'),
            ];

            $articles = $client->getArticles($condition);

            \Pagination::forge('default', [
                'total_items' => $articles['total_count'],
                'per_page' => $condition['per'],
                'pagination_url' => \Uri::current(),
                'uri_segment' => 'page',
            ]);
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

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/articles/index', [
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

            // print var_dump($article);exit;
            if (count($article['categories']))
            {
                $category = explode('/', $article['categories'][0]['path_name_prog'])[0];
                // print var_dump($category);exit;

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
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/articles/show', [
            'test' => 'test'
        ]);
    }
}
