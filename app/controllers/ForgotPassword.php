<?php

namespace App\Controllers;

/**
 * ForgotPassword Controller
 *
 * @package App\Controllers
 */
class ForgotPassword
{
    /**
     * Show reset password form
     */
    public function index()
    {
       if(! isAuthenticated()) {
           return view('forgot-password');
       }

        return redirect('');
    }
}