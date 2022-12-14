<?php

declare(strict_types=1);

namespace Core;

abstract class Router
{
    private static array $routes;

    public static function add(string $route, array $action): void
    {
        self::$routes[$route] = $action;
    }

    public static function dispatch(string $uri): void
    {
        $uri = strip_tags(trim($uri, '/'));

        $uriParameters = parse_url($uri)['query'] ?? '';
        $uri = parse_url($uri)['path'] ?? '';

        if (!self::validateUri($uri)) {
            exit('Page not found');
        }

        $method = self::$routes[$uri]['method'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            exit('Method not allowed');
        }

        $controller = self::$routes[$uri]['controller'] ?? '';

        if (!class_exists($controller)) {
            exit('Controller not found');
        }

        $action = self::$routes[$uri]['action'] ?? '';

        if (!method_exists($controller, $action)) {
            exit('Action not found');
        }

        $reflector = new \ReflectionMethod($controller, $action);
        $actionArguments = $reflector->getParameters();

        if(empty($actionArguments)){
            $controller = new $controller();

            if (!$controller->before($action)) {
                exit('Pre-requisites are not met');
            }

            $controller->$action();
            $controller->after($action);
            exit();
        }

        if(!$uriParameters){
            exit('Parameters are required');
        }

        if(!self::parseUriParameters($uriParameters)){
            exit('Invalid URL parameters');
        }

        $uriParameters = self::parseUriParameters($uriParameters);
        $parameters = [];

        foreach ($actionArguments as $actionArgument) {
            $argumentName = $actionArgument->getName();

            if (!key_exists($argumentName, $uriParameters)) {
                exit('Required argument "' . $argumentName . '" is missing');
            }

            if(!self::isPassable($uriParameters[$argumentName], $actionArgument)){
                exit($argumentName . ' is not passable parameter');
            }

            $parameters[$argumentName] = $uriParameters[$argumentName];
        }

        $controller = new $controller();

        if(!$controller->before($action)) {
            exit('Pre-requisites are not met');
        }

        call_user_func_array([$controller, $action], $parameters);
        $controller->after($action);

        dd(self::$routes);
    }

    private static function isPassable(string $value, \ReflectionParameter $parameter): bool
    {
        $parameterType = $parameter->getType()->getName();

        return match(true){
            $parameterType === 'int' => ctype_digit($value),
            $parameterType === 'string' => is_string($value),
            default => false
        };
    }

    private static function validateUri(string $uri): bool
    {
        return key_exists($uri, self::$routes);
    }

    private static function parseUriParameters(string $unparsedParameters): array|false
    {
        $unparsedParameters = explode('&', $unparsedParameters);

        $parsedParameters = [];

        foreach ($unparsedParameters as $parameter) {
            $key = explode('=', $parameter)[0] ?? '';
            $value = explode('=', $parameter)[1] ?? '';

            if(!$key || !$value){
                return false;
            }

            $parsedParameters[$key] = $value;
        }

        return $parsedParameters;
    }
}