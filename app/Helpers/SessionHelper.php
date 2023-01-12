<?php

declare(strict_types=1);

namespace App\Helpers;

class SessionHelper
{
    public static function isLoggedIn(): bool
    {
        return !empty($_SESSION['user_data']);
    }

    public static function id(): int|null
    {
        return $_SESSION['user_data']['id'] ?? null;
    }

    public static function setUserData(int $id, mixed ...$args): void
    {
        $_SESSION['user_data'] = array_merge(
            ['id' => $id],
            ...$args
        );
    }

    public static function setAlert(string $key, string $type, string $message): void
    {
        $_SESSION['alerts'][$key] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function getAlerts(): array
    {
        $alerts = $_SESSION['alerts'] ?? [];
        self::flushAlerts();
        return $alerts;
    }

    private static function flushAlerts(): void
    {
        $_SESSION['alerts'] = [];
    }

    public static function hasAlerts(): bool
    {
        return !empty($_SESSION['alerts']);
    }

    public static function isAdmin(): bool
    {
        return $_SESSION['user_data']['is_admin'] ?? false;
    }

    public static function destroy(): void
    {
        if (session_id()) {
            session_destroy();
        }
    }
}