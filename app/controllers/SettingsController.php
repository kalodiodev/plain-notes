<?php

namespace App\Controllers;

/**
 * User Settings Controller
 * 
 * @package App\Controllers
 */
class SettingsController {

    use AuthRedirection;

    /**
     * Settings page
     *
     * @return mixed
     */
    public function index()
    {
        $this->require_auth();

        return view("settings/index");
    }
}