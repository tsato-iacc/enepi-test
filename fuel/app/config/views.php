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
];
