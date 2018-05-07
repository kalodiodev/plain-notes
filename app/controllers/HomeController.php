<?php

namespace App\Controllers;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController
{
    /**
     * Home page
     */
    public function index()
    {
        return view('home');
    }
}