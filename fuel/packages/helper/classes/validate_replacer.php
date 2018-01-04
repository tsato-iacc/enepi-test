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

        if ($model)
        {
            // Old form or API request
            if ($model == 'contact' && isset($validated['gas_meter_checked_month']) && (int)$validated['gas_meter_checked_month'] > 0)
                $validated['gas_meter_checked_month'] = \Config::get('enepi.simulation.month.key_numeric.'.$validated['gas_meter_checked_month']);

            foreach ($validated as $k => $v)
            {
                if (!$v)
                    unset($validated[$k]);
            }

            if (\Config::get('models.'.$model))
            {
                foreach ($validated as $k => $v)
                {
                    if (\Config::get("models.{$model}.{$k}"))
                        $validated[$k] = \Config::get("models.{$model}.{$k}.{$v}");
                }
            }
        }

        return $validated;
    }
}
