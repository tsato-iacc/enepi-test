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

class AddValidation
{
    // validation unique value in database
    public static function _validation_unique($val, $options, $id = 0)
    {
        list($table, $field) = explode('.', $options);

        $result = \DB::select(\DB::expr("LOWER (\"$field\")"))
        ->where($field, '=', \Str::lower($val))
        ->and_where('id', '!=', $id)
        ->from($table)->execute();

        return ! ($result->count() > 0);
    }
}
