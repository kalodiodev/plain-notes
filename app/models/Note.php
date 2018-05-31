<?php

namespace App\Model;

use App\Core\Model;

/**
 * Class Note
 * 
 * @package App\Model
 */
class Note extends Model {

    public $id;
    public $title;
    public $description;
    public $details;
    public $exp_date;
    public $user_id;
    public $created_on;

    public $validate_fields = [];


}