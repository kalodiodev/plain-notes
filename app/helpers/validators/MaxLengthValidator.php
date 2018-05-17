<?php

namespace App\Helper;

/**
 * Class Maximum Length Validator
 *
 * @package App\Helper
 */
class MaxLengthValidator {

    /**
     * Validate value's maximum length
     *
     * @param $value
     * @param $max
     * @param string $message
     * @return mixed|string
     */
    public static function validate($value, $max, $message = "Value must not exceed ? characters")
    {
        $error = '';

        $message = str_replace('?', $max, $message);

        if(strlen($value) > $max)
        {
           $error = $message;
        }

        return $error;
    }
}