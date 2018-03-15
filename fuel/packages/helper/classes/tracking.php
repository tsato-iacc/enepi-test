<?php
/**
 * Helper classes
 *
 * @package    Helper
 * @version    1.0
 * @author     Zazimko Alexey
 * @license    MIT License
 */

namespace Helper;

class Tracking
{
    protected $media          = null;
    protected $pr_tracking_id = null;
    protected $pr_tracking_name = null;
    protected $from_kakaku    = false;
    protected $from_enechange = false;

    public function __construct($media = null)
    {
        $this->media = $media;
    }

    public function detect()
    {
        if (\Uri::segment(1) == 'lpgas_contacts' && in_array(\Uri::segment(2), ['new', 'new_form']))
        {
            self::unsetTracking();

            return;
        }
        
        $tracking_name = \Input::get('pr', '');

        // IF NAME DOESN'T EXIST TRY TO DETECT KAKAKU AND ENECHANGE
        if (!$tracking_name)
        {
            if ($this->isKakaku())
            {
                $this->from_kakaku = true;
                $tracking_name = \Session::get('front.is_mobile') ? 'kakaku_sp' : 'kakaku';
            }
            elseif ($this->isEnechange())
            {
                $this->from_enechange = true;
                $tracking_name = 'enechange';
            }
        }

        if ($tracking_name && $tracking = \Model_Tracking::find('first', ['where' => [['name', $tracking_name]]]))
        {
            $this->pr_tracking_id = $tracking->id;
            $this->pr_tracking_name = $tracking->name;

            \Session::set('front.pr_tracking_id', $this->pr_tracking_id);
            \Session::set('front.pr_tracking_name', $this->pr_tracking_name);
            \Session::set('front.from_kakaku', $this->from_kakaku);
            \Session::set('front.from_enechange', $this->from_enechange);
        }
        else
        {
            self::unsetTracking();
        }
    }

    public function isKakaku()
    {
        $host = parse_url(\Uri::base(), PHP_URL_HOST);

        return ($this->media == 'kakaku' || in_array('kakaku', explode('.', $host)));
    }

    public function isEnechange()
    {
        return ($this->media == 'enechange');
    }

    public static function unsetTracking()
    {
        \Session::delete('front.pr_tracking_id');
        \Session::delete('front.pr_tracking_name');
        \Session::delete('front.from_kakaku');
        \Session::delete('front.from_enechange');
    }
}
