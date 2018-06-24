<?php

namespace App\Controllers;

use App\Model\User;
use App\Core\Helper\Encrypt;
use App\Request\UserLoginRequest;
use App\Repository\UserRepositoryImpl;

/**
 * Login Controller Class
 *
 * @package App\Controllers
 */
class LoginController {

    private $usersRepository;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        global $db;
        $this->usersRepository = new UserRepositoryImpl($db);
    }

    /**
     * Login Page
     */
    public function index()
    {
        if(isAuthenticated()) {
            redirect("");
        }
        
        return view('login');
    }

    /**
     * Perform User Login
     */
    public function login()
    {
        $request = new UserLoginRequest();
        $requestedUser = $request->input()->validate()->get();

        // Check for validation errors
        if($request->hasErrors())
        {
            set_form_errors($request->errors());

            return redirect('login');
        }

        // Verify and Authenticate user
        if(($requestedUser instanceof User) && ($user = $this->usersRepository->getByEmail($requestedUser->email)))
        {
            if(Encrypt::verify($requestedUser->password, $user->password)) {

                if(! $user->isConfirmed()) {
                    error_message("Your email is not confirmed, " .
                        "click <a href=\"/confirm?resend=$user->email\">here</a> " .
                        "to resend your confirmation email");

                    return redirect('login');
                }

                authenticate($user);

                return redirect('');
            }
        }

        error_message('Wrong email or password');

        return redirect('login');
    }

    /**
     * Perform User Logout
     */
    public function logout()
    {
        signOut();

        return redirect('');
    }
}