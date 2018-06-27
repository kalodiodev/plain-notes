<?php

namespace App\Controllers;

use App\Core\Helper\TokenGenerator;
use App\Model\User;
use App\Repository\UserRepositoryImpl;
use App\Request\ForgotPasswordRequest;
use App\Services\ForgotPasswordEmail;

/**
 * ForgotPassword Controller
 *
 * @package App\Controllers
 */
class ForgotPasswordController
{
    private $usersRepository;

    /**
     * Forgot Password Controller constructor.
     */
    public function __construct()
    {
        global $db;
        $this->usersRepository = new UserRepositoryImpl($db);
    }

    /**
     * Show reset password form
     */
    public function index()
    {
       if(! isAuthenticated()) {
           return view('forgot-password');
       }

        return redirect('');
    }

    /**
     * Send token to submitted email
     */
    public function sendToken()
    {
        $request = new ForgotPasswordRequest();
        $requestedUser = $request->input()->validate()->get();

        // Check for validation errors
        if($request->hasErrors())
        {
            set_form_errors($request->errors());

            return redirect('forgot-password');
        }

        // Verify user is subscribed
        if(($requestedUser instanceof User) && ($user = $this->usersRepository->getByEmail($requestedUser->email))) {

            $token = TokenGenerator::generate();
            $expires = (new \DateTime())->add(new \DateInterval("P1D"));
            
            $this->usersRepository->update_forgot_password($user, $token, $expires);

            global $config;
            $email = new ForgotPasswordEmail($config);
            $email->send($user->email, [
                'token' => $token
            ]);
        }

        return redirect('');
    }
}