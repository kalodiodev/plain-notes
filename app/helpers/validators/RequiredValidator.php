<?php

namespace App\Helper;

/**
 * Class Required Validator
 *
 * @package App\Helper
 */
class RequiredValidator {

    /**
     * Validate required value
     *
     * @param $value
     * @param string $message
     * @return string
     */
    public static function validate($value, $message = "Value is required")
    {
        $error = '';

        if(strlen($value) == 0)
        {
            $error = $message;
        }

        return $error;
    }
}