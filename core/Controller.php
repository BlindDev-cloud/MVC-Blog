<?php

declare(strict_types=1);

namespace Core;

class Controller
{
    public function before(string $action): bool
    {
        return true;
    }

    public function after(string $action): void
    {
    }
}