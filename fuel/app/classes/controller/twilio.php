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

    public function post_say_pin()
    {
        if (\Input::extension() != 'xml') throw new \HttpNotFoundException;

        if (!$sid = \Input::post('CallSid'))
            return;

        if (!$twilio = \Model_Twilio::find('first', ['where' => [['sid', $sid]]]))
            return;

        $response = new Twiml();
        $pin      = $twilio->contact->pin;
        $options  = \Config::get('enepi.twilio.options');

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
        }
    }
}
