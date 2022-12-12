<?php

declare(strict_types=1);

namespace Core;

class Router
{
    private static array $routes;

    public static function add(string $route, array $action): void
    {
        static::$routes[$route] = $action;
    }

    public static function dispatch(string $uri): void
    {
        $uri = strip_tags(trim($uri, '/'));
        $uriParameters = parse_url($uri)['query'] ?? '';
        $uri = parse_url($uri)['path'];

        if (!static::validateUri($uri)) {
            exit('Page not found');
        }

        $method = static::$routes[$uri]['method'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            exit('Method not allowed');
        }

        $controller = static::$routes[$uri]['controller'] ?? '';

        if (!class_exists($controller)) {
            exit('Controller not found');
        }

        $action = static::$routes[$uri]['action'] ?? '';

        if (!method_exists($controller, $action)) {
            exit('Action not found');
        }

        $reflector = new \ReflectionMethod($controller, $action);
        $actionArguments = $reflector->getParameters();

        if($actionArguments === [] && $controller->before($action)){
            $reflector->invoke(new $controller());
            $controller->after($action);
            exit();
        }

        if(!$uriParameters){
            exit('Parameters are required');
        }

        $uriParameters = static::parseUriParameters($uriParameters);
        $parameters = [];

        foreach ($actionArguments as $actionArgument) {
            $argumentName = $actionArgument->getName();

            if (!key_exists($argumentName, $uriParameters)) {
                exit('Required argument "' . $argumentName . '" is missing');
            }

            if(!static::isPassable($uriParameters[$argumentName], $actionArgument)){
                exit($argumentName . ' is not passable parameter');
            }

            $parameters[$argumentName] = $uriParameters[$argumentName];
        }

        if($controller->beafore($action)) {
            $reflector->invokeArgs(new $controller(), $parameters);
            $controller->after($action);
        }
    }

    private static function isPassable(string $value, \ReflectionParameter $parameter): bool
    {
        $parameterType = $parameter->getType()->getName();

        return match(true){
            $parameterType === 'int' => ctype_digit($value),
            $parameterType === 'string' => is_string($value),
            default => false
        };

        return true;
    }

    private static function validateUri(string $uri): bool
    {
        return key_exists($uri, static::$routes);
    }

    private static function parseUriParameters(string $unparsedParameters): array
    {
        $unparsedParameters = explode('&', $unparsedParameters);

        $parsedParameters = [];

        foreach ($unparsedParameters as $parameter) {
            $key = explode('=', $parameter)[0];
            $value = explode('=', $parameter)[1];
            $parsedParameters[$key] = $value;
        }

        return $parsedParameters;
    }
}