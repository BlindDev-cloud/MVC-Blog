<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

function url(string $link = ''): string
{
    return SITE_URL . '/' . $link;
}

#[NoReturn] function redirect(string $path = ''): void
{
    header('Location: ' . url($path));
    exit();
}

function redirectBack(): void
{
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    header('Location: ' . $referer);
    exit();
}

function isAdminRoute(): bool
{
    return in_array('admin', explode('/', $_SERVER['REQUEST_URI']));
}

function isAccountRoute(): bool
{
    return in_array('account', explode('/', $_SERVER['REQUEST_URI']));
}