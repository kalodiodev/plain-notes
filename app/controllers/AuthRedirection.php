<?php

namespace App\Controllers;

/**
 * Authentication Redirect Trait
 *
 * @package App\Controllers
 */
trait AuthRedirection {

    /**
     * Redirect to login if not authenticated
     */
    protected function require_auth()
    {
        if(! isAuthenticated())
        {
            return redirect('login');
        }

        return null;
    }
}