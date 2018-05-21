<?php

/**
 * Store message to Session
 *
 * @param $message string the message to store
 * @param string $type the type of the message, default is info
 */
function message($message, $type = 'info')
{
    $_SESSION[$type . '_message'] = $message;
}

/**
 * Store error message to Session
 *
 * @param $message string the message
 */
function error_message($message)
{
    message($message, 'error');
}

/**
 * Store success message to Session
 *
 * @param $message string the message
 */
function success_message($message)
{
    message($message, 'success');
}

/**
 * Get message from Session and remove it from Session
 *
 * @param string $type the type of message, default is info
 * @return string|null the message if exists, otherwise null
 */
function get_message($type='info')
{
    $message = null;

    if(isset($_SESSION[$type . '_message'])) {
        $message = $_SESSION[$type . '_message'];
        unset($_SESSION[$type . '_message']);
    }

    return $message;
}

/**
 * Get error message from Session
 *
 * @return null|string the message
 */
function get_error_message()
{
    return get_message('error');
}

/**
 * Get success message from Session
 *
 * @return null|string the message
 */
function get_success_message()
{
    return get_message('success');
}