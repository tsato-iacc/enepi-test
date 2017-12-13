<?php

/**
 * class Lpgas::CompanyServiceFeature
 */
class Model_Contact extends \Orm\Model_Soft
{
    protected static $_table_name = 'lpgas_contacts';

    protected static $_properties = [
        'id',
        'name',
        'furigana',
        'zip_code',
        'prefecture_code',
        'address',
        'address2',
        'new_zip_code',
        'new_prefecture_code',
        'new_address',
        'new_address2',
        'house_age',
        'tel',
        'email',
        'original_contact_id',
        'from_kakaku',
        'from_enechange',
        'sent_auto_estimate_req',
        'gas_meter_checked_month',
        'gas_used_years',
        'gas_used_amount',
        'gas_latest_billing_amount',
        'gas_contracted_shop_name',
        'moving_scheduled_date',
        'body',
        'house_kind',
        'ownership_kind',
        'estimate_kind',
        'apartment_owner',
        'number_of_rooms',
        'number_of_active_rooms',
        'estate_management_company_name',
        'using_cooking_stove',
        'using_bath_heater_with_gas_hot_water_supply',
        'using_other_gas_machine',
        'status',
        'status_reason',
        'user_status',
        'terminal',
        'token',
        'pin',
        'admin_memo',
        'pr_tracking_parameter_id',
        'priority_degree',
        'desired_option',
        'preferred_contact_time_between',
        'reason_not_auto_sendable',
        'is_seen',
        'house_hold',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_UpdatedAt' => [
            'events' => ['before_update'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_Typing'
    ];

    protected static $_belongs_to = [
        'pr_tracking_parameter',
    ];
}
