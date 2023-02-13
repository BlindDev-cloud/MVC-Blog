<?php

declare(strict_types=1);

namespace App\Services;

use App\Validators\CreateCategoryValidator;

class FileUploadService implements Contracts\FileUploadServiceContract
{

    public static function upload(array $file, string $uploadDir = STORAGE_DIR): string|bool
    {
        if(!file_exists($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }

        $uploadedFileExtension = array_reverse(explode('.', $file['name']))[0];

        $uploadedFileName = date('Y-m-d_h:i:s') . '_' . uniqid('', true) . '.' . $uploadedFileExtension;

        $uploadedFilePath = $uploadDir . '/' . $uploadedFileName;

        move_uploaded_file($file['tmp_name'], $uploadedFilePath);

        return $uploadedFileName;
    }

    public static function remove(string $path): bool
    {
        return unlink($path);
    }
}