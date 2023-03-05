<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Helpers\SessionHelper;
use App\Models\Post;
use App\Validators\Post\UpdatePostValidator;
use App\Services\FileUploadService;

class RemovePostService
{
    public static function call(array $fields): void
    {
        $validator = new UpdatePostValidator();

        $validator->validate($fields);

        if (SessionHelper::hasAlerts()) {
            redirectBack();
        }

        $id = (int)$fields['id'];

        if (!$validator->postExists($id)) {
            redirectBack();
        }

        $oldImage = Post::find($id)->thumbnail;
        $oldImagePath = STORAGE_DIR . '/' . $oldImage;

        FileUploadService::remove($oldImagePath);

        Post::delete($id);
    }
}