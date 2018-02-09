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
        'house_kind' => [
            'detached' => '戸建て',
            'apartment' => 'マンション・アパート',
            'store_ex' => '店舗',
        ],
        'ownership_kind' => [
            'owner' => '所有(持ち家)',
            'borrower' => '賃貸(借り主)',
            'unit_owner' => '所有',
        ],
        'gas_machines' => [
            'using_cooking_stove' => 'ガスコンロ',
            'using_bath_heater_with_gas_hot_water_supply' => '給湯器',
            'using_other_gas_machine' => 'ストーブその他',
        ],
        'preferred_contact_time_between' => [
            // 5 => '',
            0 => 'いつでも',
            1 => '9:00~12:00',
            2 => '12:00~15:00',
            3 => '15:00~18:00',
            4 => '18:00~21:00',
        ],
        'terminal_types'   => [
            0 => '不明',
            10 => 'パソコン',
            20 => 'ガラケー',
            30 => 'スマホ',
            40 => 'タブレット',
        ],
        'priority_degree' => [
            0 => '通常',
            1 => '至急',
        ],
        'desired_option' => [
            0 => 'しない',
            1 => 'する',
        ],
        'gas_meter_checked_month' => [
            1 => '1月',
            2 => '2月',
            3 => '3月',
            4 => '4月',
            5 => '5月',
            6 => '6月',
            7 => '7月',
            8 => '8月',
            9 => '9月',
            10 => '10月',
            11 => '11月',
            12 => '12月',
        ],
        'is_seen' => [
            'unregistered' => '記録なし',
            'not_seen' => '×',
            'seen' => '◯',
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
        ],
        'status' => [
            'pending' => '未対応',
            'sent_estimate_to_iacc' => 'IACC見積もり確認中',
            'sent_estimate_to_user' => '見積もり送信済み',
            'verbal_ok' => '送客',
            'contracted' => '成約',
            'cancelled' => 'キャンセル',
        ],
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

    /**
     * Enum for Model_PriceRule
     */
    'price_rule' => [
        'house_kind' => [
            'detached' => '戸建て',
            'apartment' => 'マンション・アパート',
            'store_ex' => '店舗',
        ],
    ],
];
