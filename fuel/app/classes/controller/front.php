<?php

class Controller_Front extends Controller_Template
{
    public $template = 'front/template';

    public function after($response)
    {
        $template = $this->template;

        $template->title = isset($template->title) ? $template->title . \Config::get('enepi.meta.default.title_end') : \Config::get('enepi.meta.default.title') . \Config::get('enepi.meta.default.title_end');

        $this->createMetaData();

        return parent::after($response);
    }

    private function createMetaData()
    {
        $template = $this->template;

        $meta_default = [
            ['name' => 'description', 'content' => \Config::get('enepi.meta.default.description')],
            ['name' => 'keywords', 'content' => \Config::get('enepi.meta.default.keywords')],
        ];

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

        $template->meta = $meta_default;
    }
}
