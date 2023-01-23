<?php

declare(strict_types=1);

namespace App\Validators;

use App\Models\Category;

class UpdateCategoryValidator extends CreateCategoryValidator
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

    public function categoryExists(int $id): bool
    {
        return (bool)Category::find($id);
    }
}