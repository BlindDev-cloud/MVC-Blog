<?php

declare(strict_types=1);

namespace Core;

class View
{
    public static function render(string $view, array $args = []): void
    {
        extract($args, flags: EXTR_SKIP);

        $file = VIEW_DIR . '/' . $view . '.php';

        if (!is_readable($file)) {
            exit('File ' . $file . ' not found');
        }

        require $file;
    }
}