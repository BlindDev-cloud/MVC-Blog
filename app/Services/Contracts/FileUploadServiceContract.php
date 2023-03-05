<?php

namespace App\Services\Contracts;

interface FileUploadServiceContract
{
    public static function upload(array $file, string $uploadDir = STORAGE_DIR): string|bool;

    public static function remove(string $path): bool;
}