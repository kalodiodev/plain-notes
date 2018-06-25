<?php

namespace App\Request;

use App\Model\User;
use App\Helper\Validator;

/**
 * Forgot Password Request
 *
 * @package App\Request
 */
class ForgotPasswordRequest extends ModelRequest {

    /**
     * Get request input
     *
     * @return $this UserRequest
     */
    public function input()
    {
        $this->model = new User();

        $this->model->email = isset($_POST['email']) ? $_POST['email'] : '';

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
            'email' => [
                'required' => [
                    'value' => true,
                    'message' => "Email is required."
                ],
                'email' => [
                    'value' => true,
                    'message' => "Field must be an email."
                ]
            ]
        ];

        $this->errors = (new Validator($this->model))->validate($validate_fields)->getErrors();

        return $this;
    }
}