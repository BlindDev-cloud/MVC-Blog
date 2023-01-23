<?php

declare(strict_types=1);

namespace App\Validators;

use App\Helpers\SessionHelper;

class CreateCategoryValidator extends Base\BaseValidator
{
    protected array $errors = [
        'title' => [
            'type' => 'warning',
            'message' => 'Title must be at least 2 characters'
        ],
        'description' => [
            'type' => 'warning',
            'message' => 'Description must be at least 5 characters'
        ]
    ];

    protected array $rules = [
        'title' => '/[\w\s\t\r\n]{2,100}/',
        'description' => '/[\w\s\t\r\n]{10,}/'
    ];

    protected array $allowedMimes = [
        'image/jpeg',
        'image/png'
    ];

    public function validateImage(array $file): bool
    {
        if(!is_uploaded_file($file['tmp_name'])){
            SessionHelper::setAlert('image', 'danger', 'Image has not been uploaded');
            return false;
        }

        if(!in_array($file['type'], $this->allowedMimes)){
            SessionHelper::setAlert('image', 'danger', 'Image must be in .png or .jpg format');
            return false;
        }

        return true;
    }
}