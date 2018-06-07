<?php

namespace App\Controllers;

/**
 * Error Controller
 *
 * @package App\Controllers
 */
class ErrorController {

    /**
     * Page not found
     *
     * @return mixed
     */
    public function not_found()
    {
        return view('404');
    }
}

