<?php

/**
 * Check if form field has post/validation errors
 *
 * @param $field
 * @return bool
 */
function field_has_error($field)
{
    return (! empty($_SESSION['errors'][$field]) && (sizeof($_SESSION['errors'][$field])) > 0);
}

/**
 * Set form post/validation errors
 *
 * @param $errors
 */
function set_form_errors($errors)
{
    $_SESSION['errors'] = $errors;
}

/**
 * Clear all form errors from Session
 */
function clear_form_errors()
{
    unset($_SESSION['errors']);
}