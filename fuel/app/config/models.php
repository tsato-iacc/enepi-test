<?php

return [
    /**
     * Enum for Model_Contact
     */
    'contact' => [
        'estimate_kind' => [
            'change_contract' => 0,
            'new_contract' => 1,
        ],
        'house_kind' => [
            'detached' => 0,
            'apartment' => 1,
            'store_ex' => 2,
        ],
        'ownership_kind' => [
            'owner' => 0,
            'borrower' => 1,
            'unit_owner' => 2,
        ],
        'status' => [
            'pending' => 0,
            'sent_estimate_req' => 10,
            'cancelled_before_estimate_req' => 20,
            'verbal_ok' => 30,
            'contracted' => 40,
            'cancelled' => 50,
        ],
        // 'status_reason' => [
        // ],
        'user_status' => [
            'checking' => 0,
            'operating' => 10,
            'not_contacted' => 20,
            'confirming' => 30,
            'thinking' => 40,
            'no_action' => 999,
        ],
        'priority_degree' => [
            'regular' => 0,
            'urgent' => 1,
        ],
        'desired_option' => [
            'unnecessary' => 0,
            'necessary' => 1,
        ],
        'preferred_contact_time_between' => [
            'first_choice' => 0, //いつでも
            'second_choice' => 1, //9:00から12:00
            'third_choice' => 2, //12:00から15:00
            'fourth_choice' => 3, //15:00から18:00
            'fifth_choice' => 4, //18:00から21:00
        ],
        'is_seen' => [
            'unregistered' => 0,
            'not_seen' => 1,
            'seen' => 2,
        ],
        'gas_meter_checked_month' => [
            'january' => 1,
            'february' => 2,
            'march' => 3,
            'april' => 4,
            'may' => 5,
            'june' => 6,
            'july' => 7,
            'august' => 8,
            'september' => 9,
            'october' => 10,
            'november' => 11,
            'december' => 12
        ],
        'house_kind' => [
            'detached' => 0,
            'apartment' => 1,
            'store_ex' => 2,
        ],
    ],

    /**
     * Enum for Model_Tracking
     */
    'tracking' => [
        'cv_point' => [
            'estimate' => 0,
            'verbal_ok' => 10,
        ],
    ],

    /**
     * Enum for Model_Estimate
     */
    'estimate' => [
        'status' => [
            'pending' => 0,
            'sent_estimate_to_iacc' => 1,
            'sent_estimate_to_user' => 2,
            'verbal_ok' => 3,
            'contracted' => 4,
            'cancelled' => 5,
        ],
    ],

    /**
     * Enum for Model_PriceRule
     */
    'price_rule' => [
        'house_kind' => [
            'detached' => 0,
            'apartment' => 1,
            'store_ex' => 2,
        ],
    ],
];
