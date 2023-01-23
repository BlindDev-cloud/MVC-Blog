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
        return !empty($_SESSION['user_data']['id']) ? $_SESSION['user_data']['id'] : null;
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

    public static function setFormData(array $data): void
    {
        $_SESSION['data'] = $data;
    }

    public static function get(string $key): array
    {
        $sessionData = !empty($_SESSION[$key]) ? $_SESSION[$key] : [];
        self::flush($key);
        return $sessionData;
    }

    private static function flush(string $key): void
    {
        $_SESSION[$key] = [];
    }

    public static function hasAlerts(): bool
    {
        return !empty($_SESSION['alerts']);
    }

    public static function isAdmin(): bool
    {
        return !empty($_SESSION['user_data']['is_admin']);
    }

    public static function destroy(): void
    {
        if (session_id()) {
            session_destroy();
        }
    }
}