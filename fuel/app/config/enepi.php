<?php

return [
    'service' => [
        'name' => 'エネピ',
        'zip_code' => '105-0004',
        'address' => '東京都港区新橋1-18-16 日本生命新橋ビル5F',
        'tel' => '0120-771-664',
        'tel_kakaku' => '0120-886-447',
        'email' => 'info@enepi.jp',
        'head_office_tel' => '03-5510-8015',
        'head_office_fax' => '03-5510-8016',
    ],

    /**
     * メタデータ
     */
    'meta' => [
        // デフォルトのメタデータ (ページごとにタイトルを指定しない場合に参照)
        'default' => [
            'title' => 'プロパンガス(LPガス)の料金・価格比較でガス代を安く！',
            'title_end' => '｜【enepi -エネピ-】',
            'description' => 'プロパンガス(LPガス)の乗り換え・切り替えでガス代をおトクにするなら料金比較サービス「enepi(エネピ)」！厳選したガス会社のご紹介から切り替え完了まですべて無料サポートをするので安心してご利用頂けます',
            'keywords' => '電気料金, ガス料金, 比較, 電力自由化, ガス自由化, 電気代, ガス代, enepi, エネピ',
            'og_image' => \Uri::create('ogp_large.png'),
            'og_description' => '',
            'twitter_card_type' => 'summary',
            'twitter_card_image' => \Uri::create('ogp_small.png'),
            'twitter_card_site' => '@enepi_jp',
        ],
    ],

    /**
     * CMS Settings
     */
    'cms' => [
        'host' => getenv('CMS_ADDR'),
        'site' => getenv('CMS_SITE_ID'),
        'key'  => getenv('CMS_AUTH_KEY'),
        'category_path' => [
            'lpgas' => 'lpgas',
            'citygas' => 'citygas',
            'electricity' => 'electricity',
        ],
    ],

    /**
     * Categories
     */
    'category' => [
        'index' => [
            'per_page' => 5,
        ],
        'articles' => [
            'per_page' => 30,
        ],
        'popular' => [
            'per_page' => 4,
            'sort' => 'access_count.desc',
        ],
    ],

    /**
     * Articles
     */
    'articles' => [
        'index' => [
            'per_page' => 30,
        ],
        'popular' => [
            'per_page' => 4,
            'sort' => 'access_count.desc',
        ],
    ],

    /**
     * Simulation
     */
    'simulation' => [
        'month' => [
            'key_numeric' => [
                1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april', 5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august', 9 => 'september', 10 => 'october', 11 => 'november', 12 => 'december'
            ],
            'key_string' => [
                'january' => 1, 'february' => 2, 'march' => 3, 'april' => 4, 'may' => 5, 'june' => 6, 'july' => 7, 'august' => 8, 'september' => 9, 'october' => 10, 'november' => 11, 'december' => 12
            ],
        ],
    ],

    /**
     * Taxes
     */
    'taxes' => [
        'jp_acquisition_tax' => 1.08,
    ],

    /**
     * Household
     */
    'household' => [
        'key_numeric' => [
            2 => '2人以下',
            3 => '3人',
            4 => '4人',
            5 => '5人',
            6 => '6人',
            7 => '7人以上',
        ],
        'key_string' => [
            'two_or_less_person_household'   => '2人以下',
            'three_person_household'         => '3人',
            'four_person_household'          => '4人',
            'five_person_household'          => '5人',
            'six_person_household'           => '6人',
            'seven_or_more_person_household' => '7人以上',
        ],
        'key_numeric_string' => [
            2 => 'two_or_less_person_household',
            3 => 'three_person_household',
            4 => 'four_person_household',
            5 => 'five_person_household',
            6 => 'six_person_household',
            7 => 'seven_or_more_person_household',
        ],
        'key_string_numeric' => [
            'two_or_less_person_household'   => 2,
            'three_person_household'         => 3,
            'four_person_household'          => 4,
            'five_person_household'          => 5,
            'six_person_household'           => 6,
            'seven_or_more_person_household' => 7,
        ],
    ],

    /**
     * Terminal types [mobile, pc etc.]
     */
    'terminal_types'   => [
        'unknown'      => 0,
        'pc'           => 10,
        'mobile'       => 20,
        'smart_phone'  => 30,
        'tablet'       => 40,
    ],

    /**
     * Estimate
     */
    'estimate' => [
        'unit_price' => 250,
    ],

    /**
     * Contact
     */
    'contact' => [
        'reasons' => [
            'test' => 'テスト用の文言使用',
            'borrowed_apartment' => '賃貸アパート',
            'store' => '店舗',
            'apartment_owner' => 'マンションオーナー',
            'unit_price_less' => '推定従量単価が250円以下',
            'unit_price_zero' => '使用月、使用量、請求額が無い',
            'pr_tracking' => 'pr tracking is not auto sendable',
            'no_savings' => '年間削減効果額がマイナス',
            'unsupported_area' => 'エリア外',
            'ng_companies' => 'NG企業のみ',
            'unknown_reason' => 'Unknown reason',
            'from_kakaku' => '価格コム経由',
        ],
    ],

    /**
     * Tracking
     */
    'tracking' => [
        'admin' => [
            'history_limit' => 100,
        ],
    ],

    /**
     * Contact's cancel reason
     */
    'contact' => [
        'cancel_reasons' => [
            'status_reason_unknown' => [
              'value' => 0,
              'group' => '案件からは除外対象になるキャンセル',
              'text' => '不明',
              'hide_on_partner' => true,
            ],
            'status_reason_duplication' => [
              'value' => 1,
              'group' => '案件からは除外対象になるキャンセル',
              'text' => '重複',
              'hide_on_partner' => true,
            ],
            'status_reason_abuse' => [
              'value' => 2,
              'group' => '案件からは除外対象になるキャンセル',
              'text' => 'いたずら',
              'hide_on_partner' => true,
            ],
            'status_reason_test' => [
              'value' => 3,
              'group' => '案件からは除外対象になるキャンセル',
              'text' => 'テスト',
              'hide_on_partner' => true,
            ],
            'status_reason_resolved' => [
              'value' => 6,
              'group' => '理由不明のキャンセル',
              'text' => 'もう解決した（理由不明）',
              'hide_on_partner' => true,
            ],
            'status_reason_troublesome' => [
              'value' => 7,
              'group' => '理由不明のキャンセル',
              'text' => 'めんどくさい',
              'hide_on_partner' => true,
            ],
            'status_reason_dont_remember' => [
              'value' => 8,
              'group' => '理由不明のキャンセル',
              'text' => '身に覚えがない',
              'hide_on_partner' => true,
            ],
            'status_reason_unsupported_area' => [
              'value' => 10,
              'group' => '物理的な理由',
              'text' => '営業エリア外',
              'hide_on_partner' => false,
            ],
            'status_reason_ng_company' => [
              'value' => 20,
              'group' => '物理的な理由',
              'text' => 'NG企業',
              'hide_on_partner' => false,
            ],
            'status_reason_rent' => [
              'value' => 30,
              'group' => '物理的な理由',
              'text' => '集合住宅入居者',
              'hide_on_partner' => false,
            ],
            'status_reason_rent_not_apartment' => [
              'value' => 31,
              'group' => '物理的な理由',
              'text' => '集合住宅以外の賃貸物件',
              'hide_on_partner' => false,
            ],
            'status_reason_big_loan' => [
              'value' => 32,
              'group' => '物理的な理由',
              'text' => '貸与過大(違約金関連含む)',
              'hide_on_partner' => false,
            ],
            'status_reason_propane_concentration' => [
              'value' => 33,
              'group' => '物理的な理由',
              'text' => '集中プロパン',
              'hide_on_partner' => false,
            ],
            'status_reason_easy_gas' => [
              'value' => 34,
              'group' => '物理的な理由',
              'text' => '簡易ガス',
              'hide_on_partner' => false,
            ],
            'status_reason_city_gas' => [
              'value' => 35,
              'group' => '物理的な理由',
              'text' => '都市ガス',
              'hide_on_partner' => false,
            ],
            'status_reason_all_e' => [
              'value' => 36,
              'group' => '物理的な理由',
              'text' => 'オール電化',
              'hide_on_partner' => false,
            ],
            'status_reason_shop' => [
              'value' => 37,
              'group' => '物理的な理由',
              'text' => '業務用の店舗',
              'hide_on_partner' => false,
            ],
            'status_reason_location' => [
              'value' => 38,
              'group' => '物理的な理由',
              'text' => 'プロパンガスが置けない物件',
              'hide_on_partner' => false,
            ],
            'status_reason_request_by_user' => [
              'value' => 40,
              'group' => '既存店や新規の会社と交渉し、解決されたキャンセル',
              'text' => '他社決定(enepi内)',
              'hide_on_partner' => true,
            ],
            'status_reason_outside_of_enepi' => [
              'value' => 41,
              'group' => '既存店や新規の会社と交渉し、解決されたキャンセル',
              'text' => '他社決定(enepi外）',
              'hide_on_partner' => false,
            ],
            'status_reason_defense' => [
              'value' => 42,
              'group' => '既存店や新規の会社と交渉し、解決されたキャンセル',
              'text' => '既存店の引き止め行為による防衛',
              'hide_on_partner' => false,
            ],
            'status_reason_cant_contact' => [
              'value' => 50,
              'group' => '既存店と交渉せず、現状維持になったキャンセル',
              'text' => '連絡不可',
              'hide_on_partner' => true,
            ],
            'status_reason_price' => [
              'value' => 60,
              'group' => '既存店と交渉せず、現状維持になったキャンセル',
              'text' => 'ユーザーから安くならないと言われた',
              'hide_on_partner' => false,
            ],
            'status_reason_timing' => [
              'value' => 80,
              'group' => '既存店と交渉せず、現状維持になったキャンセル',
              'text' => '契約のタイミングが異なっていた(急ぎではない含む)',
              'hide_on_partner' => false,
            ],
            'status_reason_human_relationship' => [
              'value' => 90,
              'group' => '既存店と交渉せず、現状維持になったキャンセル',
              'text' => '既存店との付き合いで変更しない',
              'hide_on_partner' => false,
            ],
            'status_reason_family' => [
              'value' => 100,
              'group' => '既存店と交渉せず、現状維持になったキャンセル',
              'text' => '家族の合意が形成できなかった',
              'hide_on_partner' => false,
            ],
        ]
    ],
];
