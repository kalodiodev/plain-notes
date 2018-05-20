<?php

namespace App\Controllers;

use App\Request\UserRequest;

/**
 * User Register Controller Class
 *
 * @package App\Controllers
 */
class RegisterController {

    /**
     * Register page
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Store new user
     */
    public function store()
    {
        $request = new UserRequest();
        $user = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            $_SESSION['errors'] = $request->errors();
            $_SESSION['old_user'] = serialize($user);

            return redirect('register');
        }

        return redirect('');
    }

}