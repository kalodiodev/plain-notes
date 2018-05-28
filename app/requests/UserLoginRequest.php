<?php

namespace App\Request;

use App\Model\User;
use App\Helper\Validator;

/**
 * Class User Login Request
 *
 * @package App\Request
 */
class UserLoginRequest extends ModelRequest {

    /**
     * Get request input
     *
     * @return $this
     */
    public function input()
    {
        $this->model = new User();

        $this->model->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->model->password = isset($_POST['password']) ? $_POST['password'] : '';

        return $this;
    }

    /**
     * Validate request
     *
     * @return $this
     */
    public function validate()
    {
        $validation_rules = [
            'email' => [
                'required' => [
                    'value' => true,
                    'message' => "Email is required."
                ],
                'email' => [
                    'value' => true,
                    'message' => "Field must be an email."
                ]
            ],
            'password' => [
                'required' => [
                    'value' => true,
                    'message' => "Password is required."
                ]
            ]
        ];

        $this->errors = (new Validator($this->model))->validate($validation_rules)->getErrors();

        return $this;
    }
}