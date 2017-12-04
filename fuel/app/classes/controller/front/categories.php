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
            $category_children = $client->getCategoryChildren($category, $depth = 1);
        }
        catch (ClientException $e)
        {
            \Log::error($e->getMessage());

            throw new HttpNotFoundException();
        }

        if ($content['article']['redirect_url'])
            return Response::redirect($content['article']['redirect_url'], 'location', 301);


        // print var_dump($category);exit;

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/categories/index', [
            'category' => $content,
            'category_dancestors' => $category_children,
        ]);
    }
}
