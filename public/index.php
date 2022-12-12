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

    \Core\Router::dispatch($_SERVER['REQUEST_URI']);
    
}catch (Exception $exception){

}