<?php

namespace App\Request;

use App\Core\Model;

/**
 * Class Model Request
 *
 * @package App\Request
 */
abstract class ModelRequest {

    protected $model;
    protected $errors = [];

    abstract public function input();

    abstract public function validate();

    /**
     * Get posted user
     *
     * @return Model
     */
    public function get()
    {
        return $this->model;
    }

    /**
     * Get validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Has validation errors
     *
     * @return bool true if has validations errors, otherwise false
     */
    public function hasErrors()
    {
        return sizeof($this->errors) > 0;
    }
}