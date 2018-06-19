<?php

namespace App\Core\Helper;

/**
 * Token Generator Helper
 *
 * @package App\Core\Helper
 */
class TokenGenerator
{
    /**
     * Generate Token
     *
     * @param int $length
     * @param string $keyspace
     * @return string
     */
    public static function generate($length = 20, $keyspace = '0123556789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $token = '';
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $token .= $keyspace[random_int(0, $max)];
        }

        return $token;
    }
}