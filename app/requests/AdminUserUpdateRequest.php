<?php

namespace App\Request;

use App\Model\User;
use App\Helper\Validator;

/**
 * User Update Request
 *
 * @package App\Request
 */
class AdminUserUpdateRequest extends ModelRequest {

    /**
     * Get request input
     *
     * @return $this UserRequest
     */
    public function input()
    {
        $this->model = new User();

        $this->model->id = isset($_POST['id']) ? $_POST['id'] : '';
        $this->model->firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $this->model->lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';

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
            'firstName' => [
                'min' => [
                    'value' => 3,
                    'message' => "First name must be at least 3 characters long"
                ],
                'max' => [
                    'value' => 30,
                    'message' => "First name must be less or equal to 30 characters long"
                ],
                'required' => [
                    'value' => true,
                    'message' => "First name is required"
                ],
            ],
            'lastName' => [
                'min' => [
                    'value' => 3,
                    'message' => "Last name must be at least 3 characters long"
                ],
                'max' => [
                    'value' => 30,
                    'message' => "Last name must be less or equal to 30 characters long"
                ],
                'required' => [
                    'value' => true,
                    'message' => "Last name is required"
                ]
            ]
        ];

        $this->errors = (new Validator($this->model))->validate($validate_fields)->getErrors();

        return $this;
    }
}