<?php

namespace App\Model;

use App\Core\Model;
use Serializable;

/**
 * User Domain Model
 *
 * @package App\Model
 */
class User extends Model implements Serializable {

    public $validate_fields = [
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
            ]
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
        ],
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

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $password_confirmation;
    public $confirmation;
    public $forgot_password;
    public $forgot_password_expires;
    public $admin = false;

    /**
     * String representation of User object
     *
     * @return string the string representation of the User object or null
     */
    public function serialize()
    {
        return serialize([
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'admin' => $this->admin
        ]);
    }

    /**
     * Constructs the User object from string representation
     *
     * @param string $serialized string representation of User object
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->email = $data['email'];
        $this->admin = $data['admin'];
    }

    /**
     * Is user administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * Is user's email confirmed
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return empty($this->confirmation);
    }
}