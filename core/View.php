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
            throw new BaseException('Internal Server Error', 500);
        }

        require $file;
    }
}