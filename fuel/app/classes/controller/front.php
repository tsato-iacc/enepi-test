<?php

use Helper\Tracking;

class Controller_Front extends Controller_Template
{
    public $template = 'front/template';

    protected $terminal_type  = 'unknown';
    protected $is_mobile      = false;

    protected $pr_tracking_id = null;
    protected $pr_tracking_name = null;
    protected $from_kakaku    = false;
    protected $from_enechange = false;

    protected $estimate_post_url = 'lpgas_contacts';
    

    public function before()
    {
        parent::before();

        $this->mobileDetect();
        $this->prTrackingDetect();
    }

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
            ['name' => 'charset', 'content' => 'utf-8'],
            ['name' => 'description', 'content' => \Config::get('enepi.meta.default.description')],
            ['name' => 'keywords', 'content' => \Config::get('enepi.meta.default.keywords')],
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

    private function mobileDetect()
    {
        if (\Session::get('front.terminal_type') === null)
        {
            $detect = new Mobile_Detect;
            $mobile = $detect->isMobile();
            $tablet = $detect->isTablet();

            if ($mobile)
            {
                $this->is_mobile = true;
                // $this->terminal_type = 'mobile';

                if($tablet)
                {
                    $this->terminal_type = 'tablet';
                }
                else
                {
                    $this->terminal_type = 'smart_phone';
                }
            }
            else
            {
                $this->terminal_type = 'pc';
            }
            
            \Session::set('front.terminal_type', $this->terminal_type);
            \Session::set('front.is_mobile', $this->is_mobile);
        }

        // Set for usage in Controller
        $this->terminal_type = \Session::get('front.terminal_type');
        $this->is_mobile     = \Session::get('front.is_mobile');

        // Set for usage in View
        \View::set_global('is_mobile', $this->is_mobile, false);
    }

    private function prTrackingDetect()
    {
        if (\Session::get('front.pr_tracking_id', false) === false)
        {
            $tracking = new Tracking($this->param('media'));
            $tracking->detect();
        }

        if ($media = $this->param('media'))
            $this->estimate_post_url = "{$media}/lpgas/contacts";

        // Set for usage in Controller
        $this->pr_tracking_id = \Session::get('front.pr_tracking_id');
        $this->pr_tracking_name = \Session::get('front.pr_tracking_name');
        $this->from_kakaku    = \Session::get('front.from_kakaku');
        $this->from_enechange = \Session::get('front.from_enechange');

        // Set for usage in View
        \View::set_global('pr_tracking_name', $this->pr_tracking_name, false);
        \View::set_global('from_kakaku', $this->from_kakaku, false);
        \View::set_global('from_enechange', $this->from_enechange, false);
        \View::set_global('estimate_post_url', $this->estimate_post_url, false);
    }
}
