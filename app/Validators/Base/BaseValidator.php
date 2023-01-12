<?php

namespace App\Validators\Base;

use App\Helpers\SessionHelper;

class BaseValidator
{
    protected array $rules = [];
    protected array $errors = [];

    public function validate(array $fields): void
    {
        foreach ($fields as $key => $value) {
            if(!empty($this->rules[$key]) && !preg_match($this->rules[$key], $value)){
                SessionHelper::setAlert($key, $this->errors[$key]['type'], $this->errors[$key]['message']);
            }
        }
    }
}