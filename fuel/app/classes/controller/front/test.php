<?php

class Controller_Front_Test extends Controller_Front
{

    public function action_test()
    {
    	$meta = [
    			['name' => 'description', 'content' => 'OOooOOppp'],
    			['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
    			['name' => 'puka', 'content' => 'suka'],
    	];

    	$cmd = Input::post('cmd');
    	if($cmd == "twilio"){

    		$to = Input::post('to');
    		Mail::sms_send($to, "テストメッセージ\n日本語文字化けしていませんか？");

    	}else if($cmd == "mail"){

    		$to = Input::post('to');
    		Mail::mail_send("info@enepi.jp", $to, "テストメール", "届いてますか？\n日本語文字化けしていませんか？");

    	}



        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/test/test', [
            'test' => 'test'
        ]);
    }

}
