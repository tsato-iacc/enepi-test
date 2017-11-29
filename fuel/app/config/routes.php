<?php

return array(
    '_root_'  => 'front/welcome/index',
    '_404_'   => 'front/welcome/404',

    /**
     * Front
     */
    'lpgas_contacts/new_form'           => 'front/lpgasContacts',
    'lpgas_contacts/new'                => 'front/lpgasContacts/old',
    'lpgas_contacts/done'               => 'front/lpgasContacts/done',
    ':media/lpgas/contacts/new'         => 'front/lpgasContacts',
    ':media/lpgas/contacts/done'        => 'front/lpgasContacts/done',

    'simple_simulations/new'            => 'front/simpleSimulation',
    'simple_simulations'                => 'front/simpleSimulation',
    'articles'                          => 'front/articles',
    'articles/(:num)'                   => 'front/articles/show/$1',
    'electricity'                       => 'front/electricity',
    'citygas'                           => 'front/citygas',
    'lpgas'                             => 'front/lpgas',
    'lpgas/support_map'                 => 'front/lpgas/supportMap',
    'agreement'                         => 'front/lpgas/agreement',

    'categories/(:any)/articles'        => 'front/categoryArticles',
    'categories/(:any)'                 => 'front/categories',

    'local_contents'                    => 'front/localContents',
    'local_contents/(:num)'             => 'front/localContents/prefecture/$1',
    'local_contents/city_show/(:num)'   => 'front/localContents/city/$1',

    'lp/(:any)'                         => 'front/lp/$1',
    's/lp/(:any)'                       => 'front/lp/$1',
);
