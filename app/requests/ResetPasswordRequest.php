<?php

namespace App\Request;

use App\Model\User;
use App\Helper\Validator;

/**
 * Reset Password Request
 *
 * @package App\Request
 */
class ResetPasswordRequest extends ModelRequest {

    /**
     * Get request input
     *
     * @return $this UserRequest
     */
    public function input()
    {
        $this->model = new User();

        $this->model->password = isset($_POST['password']) ? $_POST['password'] : '';
        $this->model->password_confirmation = isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : '';
        $this->model->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->model->forgot_password = isset($_POST['token']) ? $_POST['token'] : '';

        return $this;
    }

    /**
     * Validate input
     *
     * @return $this
     */
    public function validate()
    {
        $validate_fields = [
            'password' => [
                'match' => [
                    'value' => 'password_confirmation',
                    'message' => "Passwords do not match."
                ],
                'min' => [
                    'value' => 6,
                    'message' => "Password must be at least 6 characters long."
                ],
                'required' => [
                    'value' => true,
                    'message' => "Password is required."
                ]
            ],
        ];

        $this->errors = (new Validator($this->model))->validate($validate_fields)->getErrors();

        return $this;
    }
}