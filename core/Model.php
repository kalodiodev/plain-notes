<?php

namespace App\Core;

/**
 * Class Model
 *
 * @package App\Core
 */
abstract class Model {

    /**
     * Array of fields and rules to be validated
     *
     * @var array
     */
    public $validate_fields = [];
}