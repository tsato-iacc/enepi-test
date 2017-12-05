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
            $category_path = rtrim(implode('/', [$category, $subOne, $subTwo, $subThree]), '/');
            $category_header = $client->getCategory($category_path);
            $category_content = $client->getCategoryContent($category_path, ['depth' => 1]);

            $condition = [
                'page' => 1,
                'per' => \Config::get('enepi.category.articles.per_page'),
            ];

            foreach ($category_content as $k => $v)
            {
                $condition['category_path'] = $v['path_name_prog'];
                $category_content[$k]['content'] = $client->getArticles($condition);
            }

            $condition['category_path'] = $category_path;
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

        if ($category_header['article']['redirect_url'])
            return Response::redirect($category_header['article']['redirect_url'], 'location', 301);

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
            'category' => $category_header,
            'category_content' => $category_content,
            'popular' => $popular,
            'pickup' => $pickup,
            'mini_nav' => true,
        ]);
    }
}
