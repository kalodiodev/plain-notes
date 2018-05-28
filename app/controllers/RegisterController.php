<?php

namespace App\Controllers;

use PDOException;
use App\Request\UserRequest;
use App\Repository\UserRepositoryImpl;

/**
 * User Register Controller Class
 *
 * @package App\Controllers
 */
class RegisterController {

    private $userRepository;

    public function __construct()
    {
        global $db;
        $this->userRepository = new UserRepositoryImpl($db);
    }

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
            set_form_errors($request->errors());
            $_SESSION['old_user'] = serialize($user);

            return redirect('register');
        }

        if($this->storeUser($user) == null) {
            return redirect('register');
        }

        return redirect('');
    }

    /**
     * @param PDOException $ex
     *
     * @return string error message
     */
    protected function exception_message(PDOException $ex)
    {
        if ($ex->getCode() == 23000) {
            return "User already exists!";
        }

        return "Failed to register! Something went wrong!";
    }

    /**
     * Store user to database
     *
     * @param $user
     * @return null|string|void
     */
    protected function storeUser($user)
    {
        try {
            $id = $this->userRepository->save($user);
        } catch (PDOException $ex) {
            $id = null;
            error_message($this->exception_message($ex));
        }
        return $id;
    }

}