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
class Controller_Front_Welcome extends Controller_Front
{
    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        // if params[:contact_id].present?
        //   @lpgas_contact = ::Lpgas::Contact.find(params[:contact_id]).dup
        //   if @lpgas_contact.house_kind.present?
        //     @house_kind = @lpgas_contact.house_kind
        //   end
        //   if @lpgas_contact.estimate_kind.present?
        //     @estimate_kind = @lpgas_contact.estimate_kind
        //   end
        //   if @lpgas_contact.token != params[:token]
        //     params.delete(:contact_id)
        //     params.delete(:token)
        //     redirect_to url_for(params)
        //   end
        // else
        //   @lpgas_contact = ::Lpgas::Contact.new
        // end

        // @slots = ::Admin::BatchEstimatePrice.order(estimate_created_at: :desc).limit(20)

        $meta = [
            ['name' => 'description', 'content' => 'プロパンガス(LPガス)の乗り換え・切り替えでガス代をおトクにするなら料金比較サービス「enepi(エネピ)」！厳選したガス会社のご紹介から切り替え完了まですべて無料サポートをするので安心してご利用頂けます'],
            ['name' => 'keywords', 'content' => '電気料金, ガス料金, 比較, 電力自由化, ガス自由化, 電気代, ガス代, enepi, エネピ'],
            ['name' => 'charset', 'content' => 'utf-8'],
        ];

        $this->template->title = 'プロパンガス(LPガス)の料金・価格比較でガス代を安く！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/welcome/index', [
            'contact' => new \Model_Contact(),
            'month_selected' => '',
        ]);
        // return Response::forge(View::forge('welcome/index'));
    }


    public function action_index2()
    {
    	$meta = [
    			['name' => 'description', 'content' => 'OOooOOppp'],
    			['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
    			['name' => 'puka', 'content' => 'suka'],
    	];

    	$this->template->title = 'TOP';
    	$this->template->meta = $meta;
    	$this->template->content = View::forge('front/welcome/index2', [
    			'test' => 'test'
    	]);
    	// return Response::forge(View::forge('welcome/index'));
    }


    /**
     * The 404 action for the application.
     *
     * @access  public
     * @return  Response
     */
    public function action_404()
    {
        $this->template->title = 'ページが見つかりませんでした';
        $this->template->content = View::forge('front/welcome/404');
        return Response::forge($this->template, 404);
    }

    public function action_500()
    {
    	$this->template->title = 'ただいま混み合っております';
    	$this->template->content = View::forge('front/welcome/500');
    	return Response::forge($this->template, 500);
    }

    public function action_503()
    {
    	$this->template->title = 'ただいま混み合っております';
    	$this->template->content = View::forge('front/welcome/500');
    	return Response::forge($this->template, 503);
    }
}
