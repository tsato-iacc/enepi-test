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

class ValidateReplacer extends \Validation
{
    public function validated($field = null, $model = null, $default = false)
    {
        $validated = parent::validated($field, $default);

        foreach ($validated as $k => $v)
        {
            if (!$v)
                unset($validated[$k]);
        }

        if ($model && \Config::get('models.'.$model))
        {
            foreach ($validated as $k => $v)
            {
                if (\Config::get("models.{$model}.{$k}"))
                    $validated[$k] = \Config::get("models.{$model}.{$k}.{$v}");
            }
        }

        return $validated;
    }
}
