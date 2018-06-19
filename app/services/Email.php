<?php

namespace App\Services;

/**
 * Email Service
 *
 * @package App\Services
 */
class Email
{
    private $config;

    protected $subject = '';

    protected $headers;


    /**
     * Constructor
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;

        $this->headers = $this->headers();
    }

    /**
     * Send email
     *
     * @param $to string email send to
     * @param $data string email content
     * @return bool
     */
    public function send($to, $data)
    {
        $message = $this->prepare($data);

        return mail($to, $this->subject, $message, $this->headers);
    }

    /**
     * Prepare Email to send
     */
    protected function prepare($data)
    {
        $message = "<html>";
        $message .= "<head><title>HTML email</title></head>";
        $message .= "<body>";
        $message .= "<p>This is an html email</p>";
        $message .= "</body>";
        $message .= "</html>";

        return $message;
    }

    /**
     * Setup email headers
     */
    protected function headers()
    {
        $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= "From: {$this->config['email_name']} <{$this->config['email']}>" . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";

        return $headers;
    }
}