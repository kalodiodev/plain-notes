<?php

namespace App\Controllers;

use App\Repository\UserRepositoryImpl;
use App\Request\AdminUserUpdateRequest;

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

    /**
     * Edit User
     */
    public function edit()
    {
        $this->require_auth();

        if(! auth()->isAdmin()) {
            return redirect('');
        }

        if(isset($_GET['id']) && ($user = $this->usersRepository->findById($_GET['id']))) {
            return view('admin/user-edit', ['user' => $user]);
        }

        return redirect('admin/users');
    }

    /**
     * Update User
     */
    public function update()
    {
        $this->require_auth();

        if(! auth()->isAdmin()) {
            return redirect('');
        }
        
        $request = new AdminUserUpdateRequest();
        $requestedUser = $request->input()->validate()->get();

        if($request->hasErrors()) {
            return $this->handleUpdateUserFormErrors($requestedUser, $request);
        }

        $this->updateUser($requestedUser);

        return redirect('admin/users');
    }

    /**
     * Handle User Update Form errors
     *
     * @param $requestedUser
     * @param AdminUserUpdateRequest $request
     */
    protected function handleUpdateUserFormErrors($requestedUser, AdminUserUpdateRequest $request)
    {
        if (isset($requestedUser->id)) {
            set_form_errors($request->errors());
            $_SESSION['old_user'] = serialize($requestedUser);

            return redirect('admin/user/edit?id=' . $requestedUser->id);
        }

        return redirect('admin/users');
    }

    /**
     * Update User
     *
     * @param $requestedUser
     */
    protected function updateUser($requestedUser)
    {
        if(isset($requestedUser->id) && ($user = $this->usersRepository->findById($requestedUser->id))) {

            $user->firstName = $requestedUser->firstName;
            $user->lastName = $requestedUser->lastName;

            $this->usersRepository->update($user);
        }
    }
}
