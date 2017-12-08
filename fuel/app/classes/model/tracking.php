<?php

/**
 * class PrTrackingParameter
 */
class Model_Tracking extends \Orm\Model
{
    protected static $_table_name = 'pr_tracking_parameters';

    protected static $_properties = [
        'id',
        'name',
        'display_name',
        'conversion_tag',
        'cv_point',
        'auto_sendable',
        'render_conversion_tag_only_if_match',
        'support_ssl',
        'last_update_admin_user_id'
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_has_many = [
        'contacts' => [
            'model_to' => 'Model_Contact',
        ],
        'history' => [
            'model_to' => 'Model_Tracking_History',
        ],
    ];
}
