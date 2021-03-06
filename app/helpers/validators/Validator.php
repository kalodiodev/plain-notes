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
     * @param null $validation_rules
     * @return $this
     */
    public function validate($validation_rules = null)
    {
        $validation_rules = $validation_rules != null ? $validation_rules : $this->model->validate_fields;

        foreach ($validation_rules as $field => $rules)
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
     * Validate field's value matched given value
     *
     * if given value corresponds to {Model} property then this property would be compared
     *
     * @param $field
     * @param $value
     * @param $message
     */
    protected function match($field, $value, $message)
    {
        if(isset($this->model->{$value})) {
            $value = $this->model->{$value};
        }

        $field_error = MatchConfirmValidator::validate($this->model->{$field}, $value, $message);

        $this->pushError($field, $field_error);
    }

    /**
     * Validate field value is an email
     *
     * @param $field
     * @param $value
     * @param $message
     */
    protected function email($field, $value, $message)
    {
        if($value == true) {
            $field_error = EmailValidator::validate($this->model->{$field}, $message);

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