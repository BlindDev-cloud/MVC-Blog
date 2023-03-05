<?php

return [
    'db' => [
        'host' => getenv('DB_HOST') ?? '',
        'port' => getenv('DB_PORT') ?? '',
        'database' => getenv('DB_NAME') ?? '',
        'user' => getenv('DB_USER') ?? '',
        'password' => getenv('DB_PASSWORD') ?? ''
    ]
];
