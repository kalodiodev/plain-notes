<?php

namespace App\Request;

use App\Model\Note;
use App\Helper\Validator;

/**
 * Note Request
 *
 * @package App\Request
 */
class NoteRequest extends ModelRequest {

    public function input()
    {
        $this->model = new Note();

        $this->model->id = isset($_POST['id']) ? $_POST['id'] : "";
        $this->model->title = isset($_POST['title']) ? $_POST['title'] : '';
        $this->model->description = isset($_POST['description']) ? $_POST['description'] : '';
        $this->model->details = isset($_POST['details']) ? $_POST['details'] : '';
        $this->model->exp_date = isset($_POST['exp_date']) ? $_POST['exp_date'] : '';
        $this->model->user_id = auth()->id;

        return $this;
    }

    public function validate()
    {
        $this->errors = (new Validator($this->model))->validate()->getErrors();

        return $this;
    }
}