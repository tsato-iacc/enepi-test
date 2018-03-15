<?php

use JpPrefecture\JpPrefecture;

class Controller_Front_Api_v1_Slot extends Controller_Rest
{
    protected $rest_format = 'json';

    public function before()
    {
        parent::before();

        // if (!\Input::is_ajax())
        //   throw new \HttpNotFoundException;
    }

    public function action_index()
    {   
        $conditions = [
            'where' => [
                ['status', '<>', 0]
            ],
        ];

        $val = Validation::forge();
        $val->add_field('start', 'start', 'match_pattern[/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/]');
        $val->add_field('end', 'start', 'match_pattern[/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/]');

        if ($val->run(\Input::get()))
        {
            if ($created_from = $val->validated('start'))
            {
                $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];
            }

            if ($created_to = $val->validated('end'))
            {
                $conditions['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to, 'Y-m-d H:i:s', 'Y-m-d', true)];            
            }
        }

        if (!$val->validated('start') && !$val->validated('end'))
        {
            $now = new \DateTime();
            $conditions['where'][] = ['created_at', '>=', $now->modify('-6 hour')->format('Y-m-d H:i:s')];
        }

        $contacts = \Model_Contact::find('all', $conditions);

        \DB::start_transaction();
        try
        {
            foreach ($contacts as $contact)
            {
                $slot_item = [
                    'price' => 0,
                ];

                if (!$zip_code = $contact->getZipCode())
                {
                    \Log::warning("Zip code is invalid for Contact ID: {$contact->id}");
                    continue;
                }

                if (!$zip = \Model_ZipCode::find('first', ['where' => [['zip_code', $zip_code]]]))
                {
                    \Log::warning("Model_ZipCode not found: {$zip_code}");
                    continue;
                }

                $slot_item['subject'] = JpPrefecture::findByCode($contact->getPrefectureCode())->nameKanji.$zip->city_name;

                $estimates = $contact->get('estimates', ['where' => [['basic_price', '>=', 0]]]);

                foreach ($estimates as $estimate)
                {
                    $saving = $estimate->total_savings_in_year($contact);

                    if ($saving > $slot_item['price'])
                    {
                        $slot_item['price'] = $saving;
                        $slot_item['estimate_id'] = $estimate->id;
                        $slot_item['estimate_created_at'] = $estimate->created_at;
                    }
                }
                
                if ($slot_item['price'] > 0)
                {
                    if (\Model_Slot::find('first', ['where' => [['estimate_id', $slot_item['estimate_id']]]]) == null)
                    {
                        $slot = new \Model_Slot($slot_item);
                        $slot->save();
                    }
                }
            }

            \DB::commit_transaction();
        }
        catch (\Exception $e)
        {
            \Log::error($e);
            \DB::rollback_transaction();
        }

        $this->response(['result' => 'success']);
    }
}
