<?php
/**
 * Helper classes
 *
 * @package    Helper
 * @version    1.0
 * @author     Zazimko Alexey
 * @license    MIT License
 */

namespace Helper;

class ModelReplacer
{
    public static function to_enum($model, $properties = null)
    {
        $replaced_properties = [];

        if ($model instanceof \Model_Estimate)
        {
            $model_name = 'estimate';
        }
        else
        {
            throw new \InvalidArgumentException('unknown type');
        }

        if (!\Config::get('views.'.$model_name))
            throw new \InvalidArgumentException('Model not found in views config');

        if ($properties)
        {
            foreach ($properties as $k => $v)
            {
                $replaced_properties[$k] = \Config::get("views.{$model_name}.{$k}") ? \Config::get("views.{$model_name}.{$k}.{$v}") : $v;
            }
        }
        else
        {
            // foreach for all properties in model
        }

        return $replaced_properties;
    }
}
