<?php

return array(
    '_root_'  => 'front/welcome/index',
    '_404_'   => 'front/welcome/404',
  	'_500_'   => 'front/welcome/500',
  	'_503_'   => 'front/welcome/503',

    /**
     * Test routing should be removed
     */
    'index2'  => 'front/welcome/index2',
    'test/test'		                                          => 'front/test/test',

    /**
     * Front
     */
    'lpgas_contacts/new_form'                                 => [['GET', new Route('front/contacts/index')]],
    'lpgas_contacts'                                          => [['POST', new Route('front/contacts/store')]],
    'lpgas_contacts/new'                                      => 'front/contacts/old',
    'lpgas_contacts/done'                                     => 'front/contacts/done',
    'lpgas/contacts/(:num)'                                   => [['GET', new Route('front/contacts/sms_confirm/$1')]],
    'lpgas/contacts/(:num)/estimates/(:any)'                  => [['GET', new Route('front/contacts/details/$1/$2')]],
    'lpgas/contacts/(:num)/introduce'                         => [['POST', new Route('front/contacts/introduce/$1')]],
    ':media/lpgas/contacts/new'                               => [['GET', new Route('front/contacts/index')]],
    ':media/lpgas/contacts'                                   => [['POST', new Route('front/contacts/store')]],
    ':media/lpgas/contacts/done'                              => 'front/contacts/done',

    'simple_simulations/new'                                  => 'front/simulations',
    'simple_simulations'                                      => 'front/simulations',
    'articles'                                                => 'front/articles',
    'articles/(:num)'                                         => 'front/articles/show/$1',
    'electricity'                                             => 'front/electricity',
    'citygas'                                                 => 'front/citygas',
    'lpgas'                                                   => 'front/lpgas',
    'lpgas/support_map'                                       => 'front/lpgas/supportMap',
    'agreement'                                               => 'front/lpgas/agreement',

    'categories/(:any)(:everything)(:everything)(:everything)/articles'  => 'front/categories/articles/$1/$2/$3/$4',
    'categories/(:any)(:everything)(:everything)(:everything)'           => 'front/categories/index/$1/$2/$3/$4',

    'local_contents'                                       => 'front/localcontents',
    'local_contents/(:num)'                                => 'front/localcontents/prefecture/$1',
    'local_contents/city_show/(:num)'                      => 'front/localcontents/city/$1',

    /**
     * LP
     */
	'lp/005/(:any)'                                        => 'front/lp/index005/$1',
    'lp/(:any)'                                            => 'front/lp/index/$1',
    's/lp/(:any)'                                          => 'front/lp/slp/$1',
  	's/(:any)'                       	                     => 'front/lp/slp/$1',

    // API
    'api/security_key'                                     => 'front/api/v1/security/key',

    /**
     * Admin
     */
    'admin'                                                => [['GET', new Route('admin/redirect')]],
    'admin/users'                                          => [['GET', new Route('admin/users/index')], ['POST', new Route('admin/users/store')]],
    'admin/users/create'                                   => [['GET', new Route('admin/users/create')]],
    'admin/users/(:num)/delete'                            => [['GET', new Route('admin/users/delete/$1')]],

    'admin/tracking'                                       => [['GET', new Route('admin/tracking/index')], ['POST', new Route('admin/tracking/store')]],
    'admin/tracking/(:num)/edit'                           => [['GET', new Route('admin/tracking/edit/$1')]],
    'admin/tracking/(:num)'                                => [['POST', new Route('admin/tracking/update/$1')]],
    'admin/tracking/(:num)/delete'                         => [['GET', new Route('admin/tracking/delete/$1')]],
    'admin/tracking/statistics'                            => [['GET', new Route('admin/tracking/statistics')]],

    'admin/partner_companies'                              => [['GET', new Route('admin/partnercompanies/index')], ['POST', new Route('admin/partnercompanies/store')]],
    'admin/partner_companies/create'                       => [['GET', new Route('admin/partnercompanies/create')]],
    'admin/partner_companies/(:num)/edit'                  => [['GET', new Route('admin/partnercompanies/edit/$1')]],
    'admin/partner_companies/(:num)'                       => [['POST', new Route('admin/partnercompanies/update/$1')]],
    'admin/partner_companies/(:num)/emails'                => [['GET', new Route('admin/partnercompanies/emails_index/$1')], ['POST', new Route('admin/partnercompanies/emails_store/$1')]],
    'admin/partner_companies/(:num)/emails/(:num)/delete'  => [['GET', new Route('admin/partnercompanies/emails_destroy/$1/$2')]],

    'admin/callings'                                       => [['GET', new Route('admin/callings/index')]],
    'admin/callings/(:num)/archive'                        => [['GET', new Route('admin/callings/archive/$1')]],
    'admin/activity'                                       => [['GET', new Route('admin/activity/index')]],
    'admin/history'                                        => [['GET', new Route('admin/history/index')], ['POST', new Route('admin/history/store')]],
    'admin/behavior'                                       => [['GET', new Route('admin/behavior/index')]],
    'admin/unsupported'                                    => [['GET', new Route('admin/unsupported/index')]],
    'admin/holiday'                                        => [['GET', new Route('admin/holiday/index')], ['POST', new Route('admin/holiday/store')]],

    'admin/estimates'                                      => [['GET', new Route('admin/estimates/index')]],
    'admin/estimates/(:num)'                               => [['GET', new Route('admin/estimates/show/$1')], ['POST', new Route('admin/estimates/update/$1')]],
    'admin/estimates/(:num)/introduce'                     => [['POST', new Route('admin/estimates/introduce/$1')]],
    'admin/estimates/(:num)/present'                       => [['POST', new Route('admin/estimates/present/$1')]],
    'admin/estimates/(:num)/cancel'                        => [['POST', new Route('admin/estimates/cancel/$1')]],
    'admin/estimates/(:num)/delete'                        => [['GET', new Route('admin/estimates/destroy/$1')]],
    'admin/estimates/(:num)/progress'                      => [['POST', new Route('admin/estimates/progress/$1')]],
    'admin/estimates/(:num)/revert/(:any)'                 => [['GET', new Route('admin/estimates/revert/$1/$2')]],
    'admin/estimates/history'                              => [['GET', new Route('admin/estimates/history')]],

    'admin/contacts'                                       => [['GET', new Route('admin/contacts/index')]],
    'admin/contacts/(:num)/edit'                           => [['GET', new Route('admin/contacts/edit/$1')]],
    'admin/contacts/(:num)/cancel'                         => [['POST', new Route('admin/contacts/cancel/$1')]],
    'admin/contacts/(:num)/delete'                         => [['POST', new Route('admin/contacts/destroy/$1')]],
    'admin/contacts/(:num)'                                => [['POST', new Route('admin/contacts/update/$1')]],
    'admin/contacts/(:num)/estimates/create'               => [['GET', new Route('admin/contacts/estimate_create/$1')]],
    'admin/contacts/(:num)/estimates'                      => [['GET', new Route('admin/contacts/estimate_index/$1')], ['POST', new Route('admin/contacts/estimate_store/$1')]],

    'admin/companies'                                      => [['GET', new Route('admin/companies/index')]],
    'admin/companies/(:num)/edit'                          => [['GET', new Route('admin/companies/edit/$1')]],
    'admin/companies/(:num)'                               => [['POST', new Route('admin/companies/update/$1')]],
    'admin/companies/(:num)/estimates'                     => [['GET', new Route('admin/companies/estimates_index/$1')]],
    'admin/companies/(:num)/ng'                            => [['GET', new Route('admin/companies/ng_index/$1')], ['POST', new Route('admin/companies/ng_store/$1')]],
    'admin/companies/(:num)/ng/(:num)/delete'              => [['GET', new Route('admin/companies/ng_destroy/$1/$2')]],

    'admin/companies/(:num)/offices'                       => [['GET', new Route('admin/companyoffices/index/$1')], ['POST', new Route('admin/companyoffices/store/$1')]],
    'admin/companies/(:num)/offices/(:num)/delete'         => [['GET', new Route('admin/companyoffices/destroy/$1/$2')]],
    'admin/companies/(:num)/offices/(:num)/prices'         => [['GET', new Route('admin/companyoffices/prices_index/$1/$2')]],
    'admin/companies/(:num)/offices/(:num)/prices/create'  => [['GET', new Route('admin/companyoffices/prices_create/$1/$2')], ['POST', new Route('admin/companyoffices/prices_store/$1/$2')]],
    'admin/companies/(:num)/offices/(:num)/prices/(:num)/delete' => [['GET', new Route('admin/companyoffices/prices_destroy/$1/$2/$3')]],
    'admin/companies/(:num)/offices/(:num)/area'           => [['GET', new Route('admin/companyoffices/area_index/$1/$2')], ['POST', new Route('admin/companyoffices/area_store/$1/$2')]],
    'admin/companies/(:num)/offices/(:num)/area/(:num)/delete' => [['GET', new Route('admin/companyoffices/area_destroy/$1/$2/$3')]],

    'admin/company_features'                               => [['GET', new Route('admin/companyfeatures/index')], ['POST', new Route('admin/companyfeatures/store')]],
    'admin/company_features/(:num)/edit'                   => [['GET', new Route('admin/companyfeatures/edit/$1')]],
    'admin/company_features/(:num)'                        => [['POST', new Route('admin/companyfeatures/update/$1')], ['DELETE', new Route('admin/companyfeatures/delete/$1')]],


    'admin/reviews'                                        => [['GET', new Route('admin/reviews/index')], ['POST', new Route('admin/reviews/store')]],
    'admin/reviews/(:num)/edit'                            => [['GET', new Route('admin/reviews/edit/$1')]],
    'admin/reviews/(:num)'                                 => [['POST', new Route('admin/reviews/update/$1')], ['DELETE', new Route('admin/reviews/delete/$1')]],

    /**
     * Partner
     */
    'partner'                                              => [['GET', new Route('partner/redirect')]],
    'partner/estimates'                                    => [['GET', new Route('partner/estimates/index')]],
    'partner/estimates/(:num)'                             => [['GET', new Route('partner/estimates/show/$1')]],
    'partner/estimates/(:num)/cancel'                      => [['POST', new Route('partner/estimates/cancel/$1')]],
    'partner/estimates/(:num)/progress'                    => [['POST', new Route('partner/estimates/progress/$1')]],
    // Old routing
    'partner/lpgas/estimates/(:any)'                       => [['GET', new Route('partner/estimates/show_old/$1')]],

    /**
     * CSV
     */
    'admin/csv/companies/(:num)/estimates'                 => [['GET', new Route('admin/csv/companies_estimates/$1')]],
    'admin/csv/estimates'                                  => [['GET', new Route('admin/csv/estimates')]],
    'admin/csv/contacts'                                   => [['GET', new Route('admin/csv/contacts')]],
    'admin/csv/contacts/(:num)/estimates'                  => [['GET', new Route('admin/csv/contacts_estimates/$1')]],
    'admin/csv/calling_histories'                          => [['GET', new Route('admin/csv/calling_histories')]],

    /**
     * Twilio
     *
     * It's a wrong route, spell with one 'l'
     */
    'twillio/forward'                                      => 'twilio/forward',
);
