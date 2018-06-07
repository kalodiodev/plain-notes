<?php

namespace App\Core\Exception;

use Exception;

/**
 * Page Not Found Exception
 *
 * @package App\Core\Exception
 */
class PageNotFoundException extends \Exception {

    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }

}