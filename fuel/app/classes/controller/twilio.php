<?php

use Twilio\Twiml;

class Controller_Twilio extends Controller
{
    public function after($response)
    {        
        $response = parent::after($response);

        $response->set_header('Content-Type', 'application/xml');
        
        return $response;
    }

    public function action_say_pin()
    {
        if (\Input::extension() != 'xml') throw new \HttpNotFoundException;
        // if (!$sid = \Input::get('CallSid'))
        //     return;

        $pin = '3468';
        $response = new Twiml();
        $options = ['voice' => 'woman', 'language' => 'ja-jp'];

        $response->say('', $options);
        $response->say('ご登録ありがとうございます。', $options);
        $response->say('エネピ運営事務局です。', $options);
        $response->say('認証コードは', $options);
        $this->sayDigit($response, $options, $pin);
        $response->say('です。このコードをenepi本人確認画面で入力してください。もう一度申し上げます', $options);
        $response->say('認証コードは', $options);
        $this->sayDigit($response, $options, $pin);
        $response->say('です。お電話ありがとうございました', $options);
        
        return $response;
    }

    public function action_forward()
    {
        return 'ok';
    }

    private function sayDigit(&$response, &$options, $pin)
    {
        foreach (str_split($pin) as $digit)
        {
            $response->say($digit, $options);
            // \Config::get('enepi.twilio.number_pronunciation')
        }
    }
}
