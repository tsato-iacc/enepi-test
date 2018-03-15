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

    /**
     * Create xml when Twilio send request to here
     * Twilio request contain CallSid so we can find witch request we send to Twilio
     */
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
        if (!$tel_income = \Input::get('Called'))
            return;

        if ($tel_income == \Config::get('enepi.twilio.forward.tel_income'))
        {
            $response = new Twiml();
            $dial = $response->dial(['callerId' => \Config::get('enepi.twilio.forward.tel_from')]);
            $dial->number(\Config::get('enepi.twilio.forward.tel_to'));

            return $response;
        }
        else
        {
            return '<?xml version="1.0" encoding="UTF-8"?><Error>unsupported called number '. $tel_income .'</Error>';
        }
    }

    /**
     * Private methods
     */
    private function sayDigit(&$response, &$options, $pin)
    {
        foreach (str_split($pin) as $digit)
        {
            if ($word = \Config::get('enepi.twilio.digit_pronunciation.'.$digit))
            {
                $response->say($word, $options);
            }
            else
            {
                $response->say($digit, $options);
            }
        }
    }
}
