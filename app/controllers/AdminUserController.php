<?php

namespace App\Controllers;

use App\Repository\UserRepositoryImpl;

/**
 * User Controller
 *
 * @package App\Admin\Controllers
 */
class AdminUserController
{
    use AuthRedirection;

    private $usersRepository;

    /**
     * User Controller constructor.
     */
    public function __construct()
    {
        global $db;
        $this->usersRepository = new UserRepositoryImpl($db);
    }

    /**
     * Index Users
     */
    public function index()
    {
        $this->require_auth();

        if(! auth()->isAdmin()) {
            return redirect('');
        }

        $users = $this->usersRepository->all();

        return view('admin/users', ['users' => $users]);
    }
}