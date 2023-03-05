<?php

declare(strict_types=1);

namespace Core;

use App\Helpers\SessionHelper;

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
            throw new BaseException();
        }

        if (!self::validateRouteAction($uri)) {
            throw new BaseException();
        }

        $controller = self::$routes[$uri]['controller'];
        $action = self::$routes[$uri]['action'];
        $reflector = new \ReflectionMethod($controller, $action);
        $actionArguments = $reflector->getParameters();

        if (empty($actionArguments)) {
            self::callRouteAction($controller, $action);
            exit();
        }

        if (!$uriParameters || !self::parseUriParameters($uriParameters)) {
            throw new BaseException();
        }

        $uriParameters = self::parseUriParameters($uriParameters);
        $parameters = self::getParameters($uriParameters, $actionArguments);

        self::callRouteActionArgs($controller, $action, $parameters);
    }

    private static function callRouteActionArgs(string $controller, string $action, array $parameters): void
    {
        $controller = new $controller();

        if (!$controller->before($action)) {
            redirectBack();
        }

        call_user_func_array([$controller, $action], $parameters);
        $controller->after($action);
    }

    private static function getParameters(array $uriParameters, array $actionArguments): array
    {
        $parameters = [];

        foreach ($actionArguments as $actionArgument) {
            $argumentName = $actionArgument->getName();

            if (!key_exists($argumentName, $uriParameters)) {
                throw new BaseException();
            }

            if (!self::isPassable($uriParameters[$argumentName], $actionArgument)) {
                throw new BaseException();
            }

            $parameters[$argumentName] = $uriParameters[$argumentName];
        }

        return $parameters;
    }

    private static function callRouteAction(string $controller, string $action): void
    {
        $controller = new $controller();

        if (!$controller->before($action)) {
            redirectBack();
        }

        $controller->$action();
        $controller->after($action);
    }

    private static function validateRouteAction(string $uri): bool
    {
        $method = self::$routes[$uri]['method'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            return false;
        }

        $controller = self::$routes[$uri]['controller'] ?? '';

        if (!class_exists($controller)) {
            return false;
        }

        $action = self::$routes[$uri]['action'] ?? '';

        if (!method_exists($controller, $action)) {
            return false;
        }

        return true;
    }

    private static function isPassable(string $value, \ReflectionParameter $parameter): bool
    {
        $parameterType = $parameter->getType()->getName();

        return match (true) {
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

            if (!$key || !$value) {
                return false;
            }

            $parsedParameters[$key] = $value;
        }

        return $parsedParameters;
    }
}