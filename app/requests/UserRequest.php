<?php

namespace App\Request;

use App\Model\User;
use App\Helper\Validator;

/**
 * Class UserRequest
 * 
 * @package App\Request
 */
class UserRequest extends ModelRequest {

    /**
     * Get request input
     *
     * @return $this UserRequest
     */
    public function input()
    {
        $this->model = new User();

        $this->model->firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $this->model->lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
        $this->model->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->model->password = isset($_POST['password']) ? $_POST['password'] : '';
        $this->model->password_confirmation =
            isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : '';

        return $this;
    }

    /**
     * Validate input
     *
     * @return $this
     */
    public function validate()
    {
        $this->errors = (new Validator($this->model))->validate()->getErrors();

        return $this;
    }
}