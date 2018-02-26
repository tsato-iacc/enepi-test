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
        'cv_point' => [
            'default' => 0,
        ],
        'auto_sendable' => [
            'default' => false,
        ],
        'render_conversion_tag_only_if_match' => [
            'default' => false,
        ],
        'support_ssl' => [
            'default' => false,
        ],
        'last_update_admin_user_id'
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_has_many = [
        'contacts' => [
            'model_to' => 'Model_Contact',
            'key_to' => 'pr_tracking_parameter_id',
        ],
        'history' => [
            'model_to' => 'Model_Tracking_History',
        ],
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate($tracking = null)
    {
        $val = ValidateReplacer::forge();
        $val->add_callable('AddValidation');

        if ($tracking === null)
            return $val;

        if ($tracking->is_new())
        {
            $val->add('name', 'name')->add_rule('required')->add_rule('match_pattern', '/\A[a-z0-9_\-]*\z/')->add_rule('unique', 'pr_tracking_parameters.name', $tracking->id);
        }

        $val->add('display_name', 'display_name')->add_rule('required')->add_rule('unique', 'pr_tracking_parameters.display_name', $tracking->id);

        $val->add_field('cv_point', 'cv_point', 'required|match_collection[estimate,verbal_ok]');
        $val->add_field('conversion_tag', 'conversion_tag', 'max_length[5000]');
        $val->add_field('render_conversion_tag_only_if_match', 'render_conversion_tag_only_if_match', 'match_value[1]');
        $val->add_field('auto_sendable', 'auto_sendable', 'match_value[1]');
        
        return $val;
    }

    /**
     * Wrapper for save model
     * @param  [type]  $cascade         [description]
     * @param  boolean $use_transaction [description]
     * @return bool                     Return parrent result
     */
    public function save($cascade = null, $use_transaction = false)
    {
        $admin_id = Eauth::instance('admin')->get('id');
        $this->last_update_admin_user_id = $admin_id ? $admin_id : null;
        
        return parent::save($cascade, $use_transaction);
    }

    // FIX ME
    public function checkSSLSupport()
    {
        $this->support_ssl = true;
    }


    public function conversion_tags_for($cv_point, $conversion_id)
    {

        $conversion_tag1 = '';
        if($this->cv_point == $cv_point)
        {
            $conversion_tag1 = $this->conversion_tag;
        }


        $conversion_tag2 = '';
        $tracking_all = \Model_Tracking::find('all');
        foreach($tracking_all as $t)
        {
            if($t->render_conversion_tag_only_if_match == 0 && $t->name != $this->name && $t->cv_point == $cv_point)
            {
                $conversion_tag2 = $conversion_tag2.$t->conversion_tag;
            }
        }

        return str_replace('{cv_id}', $conversion_id, $conversion_tag1.$conversion_tag2);
    }

}
