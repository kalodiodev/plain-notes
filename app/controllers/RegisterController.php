<?php

namespace App\Controllers;

use App\Core\Helper\TokenGenerator;
use App\Model\User;
use App\Services\ConfirmEmail;
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
        /* @var $user User */
        $request = new UserRequest();
        $user = $request->input()->validate()->get();

        if($request->hasErrors())
        {
            set_form_errors($request->errors());
            $_SESSION['old_user'] = serialize($user);

            return redirect('register');
        }

        $user->confirmation = TokenGenerator::generate();

        if($this->storeUser($user) == null) {
            return redirect('register');
        }

        $this->sendConfirmationEmail($user);

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

    /**
     * Send Confirmation email
     *
     * @param $user
     */
    protected function sendConfirmationEmail(User $user)
    {
        global $config;
        $email = new ConfirmEmail($config);

        $email->send($user->email, [
            'token' => $user->confirmation
        ]);
    }

    /**
     * Confirm user email
     */
    public function confirm()
    {
        if($this->resend_confirmation_email()) {

            return redirect('login');
        }
        
        $token = isset($_GET['token']) ? $_GET['token'] : null;

        if($token == null || empty($token)) {
            return redirect('');
        }

        if($user = $this->userRepository->findByConfirmationToken($token)) {

            $this->userRepository->update_confirmation($user, "");
            authenticate($user);

            return redirect('');
        }

        return redirect('');
    }

    /**
     * Resend confirmation email
     *
     * @return bool if request requires resend, otherwise false
     */
    protected function resend_confirmation_email()
    {
        if(isset($_GET['resend'])) {
            $user = $this->userRepository->getByEmail($_GET['resend']);

            if ($user != null) {
                $this->sendConfirmationEmail($user);
            }

            return true;
        }

        return false;
    }

}