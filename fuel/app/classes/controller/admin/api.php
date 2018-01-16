<?php

class Controller_Admin_Api extends Controller_Rest
{
    const PER_PAGE = 10;

    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        if (!\Input::is_ajax())
          throw new HttpNotFoundException;
    }

    public function get_contact_cancel_reasons()
    {
        $result = [];

        if ($group = \Input::get('group'))
        {
            $result = \Helper\CancelReasons::getReasonsByGroup($group);
        }
        
        $this->response(['result' => $result]);
    }
}
