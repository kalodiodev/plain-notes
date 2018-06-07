<?php

use App\Core\Exception\PageNotFoundException;

function exception_handler($exception)
{
    if($exception instanceof PageNotFoundException)
    {
        redirect('404');
    }
}

set_exception_handler('exception_handler');