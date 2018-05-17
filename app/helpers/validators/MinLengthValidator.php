<?php

namespace App\Helper;

/**
 * Class Minimum Length Validator
 *
 * @package App\Helper
 */
class MinLengthValidator {

    /**
     * Validate value's minimum length
     *
     * @param $value
     * @param $min
     * @param string $message
     * @return mixed|string
     */
    public static function validate($value, $min, $message = "Value must be at least ? characters long")
    {
        $message = str_replace('?', $min, $message);
        $error = '';

        if(strlen($value) < $min && strlen($value) > 0)
        {
            $error = $message;
        }

        return $error;
    }
}