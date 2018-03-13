<?php

class Controller_Front_Test extends Controller_Front
{

    public function action_test()
    {
        // Disable access
        throw new \HttpNotFoundException;
        
    	$cmd = Input::post('cmd');
    	if($cmd == "twilio"){

    		$to = Input::post('to');
    		\Helper\Twilio::sms($to, "テストメッセージ\n日本語文字化けしていませんか？");

    	}else if($cmd == "mail"){

    		$to = Input::post('to');
            $email = \Email::forge();
            $email->to($to, \Config::get('enepi.service.name'));
            $email->subject('テストメール');
            $email->html_body("届いてますか？\n日本語文字化けしていませんか？");
            $email->send();

    	}else if($cmd == "talk"){

    		$to = Input::post('to');
    		\Helper\Twilio::sms($to, "テストメッセージ\n日本語文字化けしていませんか？");

    	}



        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/test/test', [
            'test' => 'test'
        ]);
    }

}
