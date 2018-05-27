<?php

namespace App\Request;

use App\Model\User;

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
        return $this;
    }
}