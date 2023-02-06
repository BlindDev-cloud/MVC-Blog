<?php

declare(strict_types=1);

namespace App\Validators\Post;

use App\Models\Post;

class UpdatePostValidator extends CreatePostValidator
{
    public function __construct()
    {
        $this->addErrors([
            'id' => [
                'type' => 'danger',
                'message' => 'Invalid id'
            ]
        ]);

        $this->addRules([
            'id' => '/^\d{1,}$/'
        ]);
    }
}