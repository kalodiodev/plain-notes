<?php

namespace App\Helper;

/**
 * Class Email Validator
 * 
 * @package App\Helper
 */
class EmailValidator {

    /**
     * Validate value is an email
     *
     * @param $value
     * @param string $message
     * @return string
     */
    public static function validate($value, $message = "Field must be an email")
    {
        $error = '';

        if(strlen($value) > 0 && ! filter_var($value, FILTER_VALIDATE_EMAIL))
        {
            $error = $message;
        }

        return $error;
    }

}