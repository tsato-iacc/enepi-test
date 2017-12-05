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
    public function action_index($category)
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $content = $client->getCategory($category);
            $sub_categories = $client->getSubCategory($category, ['depth' => 1]);

            $condition = [
                'page' => 1,
                'per' => \Config::get('enepi.category.articles.per_page'),
            ];

            foreach ($sub_categories as $k => $v)
            {
                $condition['category_path'] = $v['path_name_prog'];
                $sub_categories[$k]['content'] = $client->getArticles($condition);
            }

            $condition['category_path'] = $category;
            $articles = $client->getArticles($condition);


            $condition['category_path'] = \Config::get('enepi.cms.category_path.citygas');
            $condition['per'] = \Config::get('enepi.category.popular.per_page');
            $condition['sort'] = \Config::get('enepi.category.popular.sort');

            $popular = $client->getArticles($condition);

            if ($category == 'lpgas_before')
                $category = str_replace('_before', '', $category);

            $pickup = $client->getArticlesByModule('pickup_' . $category);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        if ($content['article']['redirect_url'])
            return Response::redirect($content['article']['redirect_url'], 'location', 301);

        // FIX ME!
        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        // FIX ME!
        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        
        $this->template->content = View::forge('front/categories/index', [
            'category' => $content,
            'sub_categories' => $sub_categories,
            'popular' => $popular,
            'pickup' => $pickup,
            'mini_nav' => true,
        ]);
    }
}
