<?php

namespace App\Controllers;

use App\Repository\UserRepositoryImpl;
use App\Request\UserInfoRequest;
use App\Request\UserPasswordRequest;

/**
 * User Controller
 * 
 * @package App\Controllers
 */
class UserController {

    use AuthRedirection;

    private $usersRepository;

    /**
     * Constructor.
     */
    public function __construct()
    {
        global $db;
        $this->usersRepository = new UserRepositoryImpl($db);
    }

    /**
     * Update User info
     */
    public function info_update()
    {
        $this->require_auth();

        $request = new UserInfoRequest();
        $user = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            set_form_errors($request->errors());
            $_SESSION['old_user'] = serialize($user);

            return redirect('settings');
        }

        $user->id = auth()->id;

        $result = $this->usersRepository->update($user);

        if($result) {
            $auth = auth();
            $auth->firstName = $user->firstName;
            $auth->lastName = $user->lastName;

            authenticate($auth);
        }

        return redirect('settings');
    }

    /**
     * Update user password
     */
    public function password_update()
    {
        $this->require_auth();

        $request = new UserPasswordRequest();
        $user = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            set_form_errors($request->errors());
            $_SESSION['old_user'] = serialize($user);

            return redirect('settings');
        }

        $this->usersRepository->update_password(auth()->id, $user->password);

        return redirect('settings');
    }
    
}