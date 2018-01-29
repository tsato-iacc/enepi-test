<?php

return [
    /**
     * Enum for Model_Contact
     */
    'contact' => [
        'status' => [
            0 => 'pending',
            10 => 'sent_estimate_req',
            20 => 'cancelled_before_estimate_req',
            30 => 'verbal_ok',
            40 => 'contracted',
            50 => 'cancelled',
        ],
        'user_status' => [
            0 => 'checking',
            10 => 'operating',
            20 => 'not_contacted',
            30 => 'confirming',
            40 => 'thinking',
            999 => 'no_action',
        ],

        'house_kind' => [
            0 => 'detached',
            1 => 'apartment',
            2 => 'store_ex',
        ],
    ],

    /**
     * Enum for Model_Tracking
     */
    'tracking' => [
        'cv_point' => [
          0 => 'estimate',
          10 => 'verbal_ok',
        ]
    ],

    /**
     * Enum for Model_CallingHistory
     */
    'calling_history' => [
        'calling_method' => [
            0 => 'tel',
            10 => 'email',
            20 => 'chat',
        ],
    ],

    /**
     * Enum for Model_Estimate
     */
    'estimate' => [
        'status' => [
            0 => 'pending',
            1 => 'sent_estimate_to_iacc',
            2 => 'sent_estimate_to_user',
            3 => 'verbal_ok',
            4 => 'contracted',
            5 => 'cancelled',
        ],
    ],

    /**
     * Enum for Model_PriceRule
     */
    'price_rule' => [
        'house_kind' => [
            0 => 'detached',
            1 => 'apartment',
            2 => 'store_ex',
        ],
    ],
];
