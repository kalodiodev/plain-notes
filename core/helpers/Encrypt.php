<?php

namespace App\Core\Helper;

/**
 * Encrypt Password helper class
 *
 * @package App\Core\Helper
 */
class Encrypt {

    /**
     * Encrypt string
     *
     * @param $value string the value to be encrypted
     * @return bool|string encrypted value
     */
    public static function encrypt($value)
    {
        $options = [
            'cost' => 11
        ];

        return password_hash($value, PASSWORD_BCRYPT, $options);
    }

    /**
     * Verify given value matches the given encrypted
     *
     * @param $value string unencrypted value
     * @param $encrypted string encrypted value
     * @return bool true if values match, otherwise false
     */
    public static function verify($value, $encrypted)
    {
        return password_verify($value, $encrypted);
    }

}