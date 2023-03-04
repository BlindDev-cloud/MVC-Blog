<?php

if(!session_id()){
    session_start();
}

require_once dirname(__DIR__) . '/config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
$dotenv->load();

try {

    require_once BASE_DIR . '/routes/web.php';

    if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])) {
        \Core\Router::dispatch($_SERVER['REQUEST_URI']);
    }

}catch (\Core\BaseException $exception){
    \Core\View::render('errorPage', [
        'message' => $exception->getMessage(),
        'code' => $exception->getCode()
    ]);
}