<?php

namespace App\Validators;

use App\Helpers\SessionHelper;

class ImageValidator extends Base\BaseValidator
{
    protected array $allowedMimes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    public function validateImage(array $file): bool
    {
        if(!is_uploaded_file($file['tmp_name'])){
            SessionHelper::setAlert('image', 'danger', 'Image has not been uploaded');
            return false;
        }

        if(!in_array($file['type'], $this->allowedMimes)){
            SessionHelper::setAlert('image', 'danger', 'File format not allowed');
            return false;
        }

        return true;
    }
}