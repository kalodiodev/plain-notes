<?php

function field_has_error($field)
{
    return (! empty($_SESSION['errors'][$field]) && (sizeof($_SESSION['errors'][$field])) > 0);
}