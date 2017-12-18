<?php

use Cms\Client;
use Cms\Exceptions\ClientException;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Front_Sidebar extends Presenter
{
    /**
     * Get popular and pickup articles
     *
     * @return void
     */
    public function view()
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $condition = [
                'page' => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per' => \Config::get('enepi.articles.popular.per_page'),
                'sort' => \Config::get('enepi.articles.popular.sort'),
            ];

            $this->popular = $client->getArticles($condition);
            $this->pickup = $client->getArticlesByModule('pickup');
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }
    }

    /**
     * Get only popular articles
     *
     * @return void
     */
    public function popular()
    {
        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $condition = [
                'page' => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per' => \Config::get('enepi.articles.popular.per_page'),
                'sort' => \Config::get('enepi.articles.popular.sort'),
            ];

            $this->popular = $client->getArticles($condition);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }
    }

    /**
     * Get popular and pickup articles for Categories Controller
     *
     * @return void
     */
    public function category()
    {
        $category = Uri::segment(2);

        $client = new Client(\Config::get('enepi.cms.host'), \Config::get('enepi.cms.site'), \Config::get('enepi.cms.key'));

        try
        {
            $condition = [
                'page' => '1',
                'category_path' => \Config::get('enepi.cms.category_path.citygas'),
                'per' => \Config::get('enepi.category.popular.per_page'),
                'sort' => \Config::get('enepi.category.popular.sort'),
            ];

            $this->popular = $client->getArticles($condition);

            if ($category == 'lpgas_before')
                $category = str_replace('_before', '', $category);

            $this->pickup = $client->getArticlesByModule('pickup_' . $category);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }
    }


}
