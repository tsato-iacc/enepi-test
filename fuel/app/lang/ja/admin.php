<?php

return [
    /**
     * Enum for Model_Tracking
     */
    'tracking' => [
        'cv_point' => [
          'estimate' => '見積もり',
          'verbal_ok' => '送客',
        ],
    ],

    /**
     * Enum for Model_Contact
     */
    'contact' => [
        'status' => [
            'pending' => '紹介前',
            'sent_estimate_req' => '紹介済み',
            'cancelled_before_estimate_req' => '紹介前キャンセル',
            'verbal_ok' => '送客',
            'contracted' => '成約',
            'cancelled' => '紹介済みキャンセル',
        ],
        'user_status' => [
            'checking' => '情報確認',
            'operating' => '見積もり対応中',
            'not_contacted' => '未接続',
            'confirming' => '確認中',
            'thinking' => '検討中',
            'no_action' => '',
        ],
    ],

    'estimate' => [
        'progress' => [
            'unknown' => '未連絡',
            'contacted' => '連絡済み',
            'visited' => '訪問済み',
            'power_of_attorney_acquired' => '委任状獲得済み',
            'construction_scheduled_date' => '工事予定',
            'construction_finished_date' => '工事完了',
        ]
    ],

    /**
     * Enum for Model_CallingHistory
     */
    'calling_history' => [
        'calling_method' => [
            'tel' => '電話',
            'email' => 'メール',
            'chat' => 'チャット',
        ],
    ],
];
