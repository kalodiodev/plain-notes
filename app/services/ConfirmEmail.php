<?php

namespace App\Services;

/**
 * Confirm Email
 *
 * @package App\Services
 */
class ConfirmEmail extends Email
{
    protected $subject = "Confirm your email...";

    /**
     * Prepare email to send
     *
     * @param $data
     * @return string
     */
    protected function prepare($data)
    {
        global $config;

        $href = $config['confirm_url'] . '?token=' . $data['token'];

        $message = <<<EOD
        <!doctype html>
        <html>
        <body>
        <h1>Confirm your email</h1>
        <p>To confirm your email click <a href="$href">Here</a></p>
        </body>
        </html>
EOD;

        return $message;
    }
}