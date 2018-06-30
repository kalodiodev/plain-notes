<?php

namespace App\Services;

/**
 * Confirm Email
 *
 * @package App\Services
 */
class ForgotPasswordEmail extends Email
{
    protected $subject = "Your password reset link...";

    /**
     * Prepare email to send
     *
     * @param $data
     * @return string
     */
    protected function prepare($data)
    {
        global $config;

        $href = $config['reset_password'] . '?email=' . $data['email'] . '&token=' . $data['token'];

        $message = <<<EOD
        <!doctype html>
        <html>
        <body>
        <h1>Reset your password</h1>
        <p>To reset your password click <a href="$href">Here</a></p>
        <p>This link expires in 24 hours</p>
        </body>
        </html>
EOD;

        return $message;
    }
}