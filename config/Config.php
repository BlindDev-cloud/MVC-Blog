<?php

declare(strict_types=1);

namespace Config;

class Config
{
    protected static array $configs = [];

    public static function get(string $name): mixed
    {
        if(empty($configs)) {
            $configs = require __DIR__ . '/configs.php';
        }

        $keys = explode('.', $name);

        return self::findByKeys($keys, $configs);
    }

    protected static function findByKeys(array $keys, array $configs): mixed
    {
        $value = null;

        if(empty($keys)){
            return $value;
        }

        $key = array_shift($keys);

        if(key_exists($key, $configs)){
            $value = is_array($configs[$key]) ? self::findByKeys($keys, $configs[$key]) : $configs[$key];
        }

        return $value;
    }
}