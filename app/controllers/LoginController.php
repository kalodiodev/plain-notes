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
        return view('login');
    }

    /**
     * Perform User Login
     */
    public function login()
    {
        $request = new UserLoginRequest();
        $requestedUser = $request->input()->validate()->get();

        if(($requestedUser instanceof User) && ($user = $this->usersRepository->getByEmail($requestedUser->email)))
        {
            if(Encrypt::verify($requestedUser->password, $user->password)) {

                authenticate($requestedUser);

                return redirect('');
            }
        }

        error_message('Wrong email or password');

        return redirect('login');
    }
}