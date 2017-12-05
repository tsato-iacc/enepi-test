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
            'title' => 'default',
            'title_end' => '｜【enepi-エネピ-】',
            'description' => 'vvv',
            'keywords' => 'aa',
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
        'articles' => [
            'per_page' => 5,
        ],
        'popular' => [
            'per_page' => 4,
            'sort' => 'access_count.desc',
        ],
    ],
];
