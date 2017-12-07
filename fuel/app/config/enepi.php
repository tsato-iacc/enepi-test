<?php

return [
    'company' => [
        'zip_code' => '105-0004',
        'address' => '東京都港区新橋1-18-16 日本生命新橋ビル5F',
        'tel' => '03-5510-8015',
        'fax' => '03-5510-8016',
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
];
