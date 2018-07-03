<?php

namespace App\Controllers;

use App\Core\Helper\TokenGenerator;
use App\Model\User;
use App\Repository\UserRepositoryImpl;
use App\Request\ForgotPasswordRequest;
use App\Request\ResetPasswordRequest;
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
            $expires = (new \DateTime())->add(new \DateInterval("P1D"))->format('Y-m-d H:i:s');
            
            $this->usersRepository->update_forgot_password($user, $token, $expires);

            global $config;
            $email = new ForgotPasswordEmail($config);
            $email->send($user->email, [
                'email' => $user->email,
                'token' => $token
            ]);
        }

        return redirect('');
    }

    /**
     * Show Reset Password Form
     */
    public function resetForm()
    {
        if(isAuthenticated()) {
            // User is already authenticated
            return redirect('');
        }

        if((isset($_GET['email']) && isset($_GET['token']))) {
            $email = $_GET['email'];
            $token = $_GET['token'];
        } else {
            return redirect('');
        }

        /** @var User $user */
        if($user = $this->usersRepository->findByEmailAndResetPasswordToken($email, $token)) {

            if(\DateTime::createFromFormat('Y-m-d H:i:s', $user->forgot_password_expires) < (new \DateTime())) {
                // Token expired
                return redirect('');
            }

            return view('reset-password', [
                'email' => $user->email,
                'token' => $user->forgot_password
            ]);
        }

        return redirect('');
    }

    /**
     * Reset Password
     */
    public function resetPassword()
    {
        if(isAuthenticated()) {
            return redirect('');
        }

        $request = new ResetPasswordRequest();
        /** @var User $requestOfUser */
        $requestOfUser = $request->input()->validate()->get();

        if((empty($requestOfUser->email)) || (empty($requestOfUser->forgot_password))) {
            return redirect('');
        }

        // Check for validation errors
        if($request->hasErrors())
        {
            set_form_errors($request->errors());

            return redirect('reset-password');
        }

        if($user = $this->usersRepository->findByEmailAndResetPasswordToken($requestOfUser->email, $requestOfUser->forgot_password)) {

            // Update password
            $this->usersRepository->update_password($user->id, $requestOfUser->password);

            // Clear forgot password token
            $this->usersRepository->update_forgot_password($user, null, null);

            authenticate($user);

            return redirect('');
        }

        return redirect('');
    }
}