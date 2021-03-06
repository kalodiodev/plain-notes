<?php

namespace App\Model;

use App\Core\Model;
use Serializable;

/**
 * Class Note
 * 
 * @package App\Model
 */
class Note extends Model implements Serializable {

    public $id;
    public $title;
    public $description;
    public $details;
    public $exp_date;
    public $user_id;
    public $created_on;

    public $validate_fields = [
        'title' => [
            'required' => [
                'value' => true,
                'message' => "Title is required"
            ],
            'min' => [
                'value' => 3,
                'message' => "Title must be at least 3 characters long"
            ],
            'max' => [
                'value' => 60,
                'message' => "Title must be less or equal to 60 characters long"
            ]
        ],
        'description' => [
            'required' => [
                'value' => true,
                'message' => "Description is required"
            ],
            'min' => [
                'value' => 3,
                'message' => "Description must be at least 3 characters long"
            ],
            'max' => [
                'value' => 180,
                'message' => "Description must be less or equal to 180 characters long"
            ]
        ]
    ];


    /**
     * String representation of Note object
     *
     * @return string the string representation of the Note object or null
     */
    public function serialize()
    {
        return serialize([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'details' => $this->details,
            'exp_date' => $this->exp_date
        ]);
    }

    /**
     * Constructs the Note object from string representation
     *
     * @param string $serialized string representation of Note object
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->details = $data['details'];
        $this->exp_date = $data['exp_date'];
    }
}