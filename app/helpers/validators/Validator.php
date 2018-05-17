<?php

namespace App\Helper;

use App\Core\Model;

/**
 * Model fields validator
 *
 * @package App\Helper
 */
class Validator {

    private $model;

    private $errors = [];

    /**
     * Validator constructor.
     *
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Perform validation
     *
     * @return $this
     */
    public function validate()
    {
        foreach ($this->model->validate_fields as $field => $rules)
        {
            foreach ($rules as $rule => $properties)
            {
                $this->$rule($field, $properties['value'], $properties['message']);
            }
        }

        return $this;
    }

    /**
     * Minimum length field validation
     *
     * @param $field
     * @param $value
     * @param $message
     */
    protected function min($field, $value, $message)
    {
        $field_error = MinLengthValidator::validate($this->model->{$field}, $value, $message);

        $this->pushError($field, $field_error);
    }

    /**
     * Maximum length field validation
     *
     * @param $field
     * @param $value
     * @param $message
     */
    protected function max($field, $value, $message)
    {
        $field_error = MaxLengthValidator::validate($this->model->{$field}, $value, $message);

        $this->pushError($field, $field_error);
    }

    /**
     * Required field validation
     *
     * @param $field
     * @param $value
     * @param $message
     */
    protected function required($field, $value, $message)
    {
        if($value == true)
        {
            $field_error = RequiredValidator::validate($this->model->{$field}, $message);

            $this->pushError($field, $field_error);
        }
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Push error to errors array
     *
     * @param $field string field error belongs to
     * @param $field_error string error message
     */
    protected function pushError($field, $field_error)
    {
        if (!empty($field_error)) {
            $this->errors[$field][] = $field_error;
        }
    }
}