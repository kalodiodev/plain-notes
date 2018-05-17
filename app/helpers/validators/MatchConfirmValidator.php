<?php

namespace App\Helper;

/**
 * Class Match Confirm Validator
 *
 * @package App\Helper
 */
class MatchConfirmValidator {

    /**
     * Validate field matched given value
     *
     * @param $value
     * @param $confirm_value
     * @param string $message
     * @return string
     */
    public static function validate($value, $confirm_value, $message = "Values do not match.")
    {
        $error = '';

        if($value !== $confirm_value)
        {
            $error = $message;
        }

        return $error;
    }

}