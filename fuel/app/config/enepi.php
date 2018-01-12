<?php

return [
    'company' => [
        'service_name' => 'エネピ',
        'zip_code' => '105-0004',
        'address' => '東京都港区新橋1-18-16 日本生命新橋ビル5F',
        'tel' => '03-5510-8015',
        'fax' => '03-5510-8016',
        'email' => 'info@enepi.jp',
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
];
