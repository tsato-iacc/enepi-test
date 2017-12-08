<?php

use Fuel\Core\Config;
use Fuel\Core\Controller_Template;
use Fuel\Core\View;

class Controller_Front extends Controller_Template
{
    public $template = 'front/template';


    public function Controller_Front(){

        $url = $_SERVER["REQUEST_URI"];

        if($url == "/agreement"){
            $this->template = 'front/template_agreement';
        }

    }

    public function after($response)
    {
        $template = $this->template;

        $template->title = isset($template->title) ? $template->title . Config::get('enepi.meta.default.title_end') : Config::get('enepi.meta.default.title') . Config::get('enepi.meta.default.title_end');

        $this->createMetaData();

        return parent::after($response);
    }

    public function temp_agreement(){
        $this->template = View::forge('template_agreement');
    }

    private function createMetaData()
    {
        $template = $this->template;

        $meta_default = [
            ['name' => 'description', 'content' => Config::get('enepi.meta.default.description')],
            ['name' => 'keywords', 'content' => Config::get('enepi.meta.default.keywords')],
        ];

        if (isset($template->meta))
        {
            foreach ($template->meta as $val)
            {
                $new = true;

                foreach ($meta_default as $k => $v)
                {
                    if ($v['name'] == $val['name'])
                    {
                        $meta_default[$k]['content'] = $val['content'];
                        $new = false;
                        break;
                    }
                }

                if ($new)
                {
                    $meta_default[] = $val;
                }
            }
        }

        $template->meta = $meta_default;
    }
}
