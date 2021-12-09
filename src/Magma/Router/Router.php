<?php

declare(strict_types=1);

namespace Magma\Router;

use Exception;
use Magma\Router\RouterInterface;

class Router implements RouterInterface
{
    /**
     * returns an array of route from our routing table
     * @var array
     */
    protected array $route = [];

    /**
     * returns an array of route parameters
     * @var array
     */
    protected array $params = [];

     /**
     * Adds a suffix onto the controller name
     * @var string
     */
    protected string $controllerSuffix = 'controller';

    /**
     * @inheritDoc
     */
    public function add(string $route, array $params = []): void
    {
        // Convert the route to a regular expression: escape forward slashes
        // $route = preg_replace('/\//', '\\', $route);

        // Convert variables e.g. {controller}
        // $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        // $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        // $route = '/^' . $route . '$/i';
        
        $this->routes[$route] = $params;

    }

    public function dispatch(string $url): void
    {
        $url = $this->formatQueryString($url);
        if ($this->match($url)) {
            $controllerString = $this->params['controller'] . $this->controllerSuffix;
            $controllerString = $this->transformUpperCamelCase($controllerString);
            $controllerString = $this->getNamespace($controllerString) . $controllerString;

            if (class_exists($controllerString)) {
                $controllerObject = new $controllerString($this->params);
                $action = $this->params['action'];
                $action = $this->transformCamelCase($action);

                if (\is_callable([$controllerObject, $action])) {
                    $controllerObject->$action();
                } else {
                    throw new Exception('Invalid method');
                }
            } else {
                throw new Exception('Controller class does not exist');
            }
        } else {
            throw new Exception('404 ERROR no page found');
        }
    }

    public function transformUpperCamelCase(string $string) : string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    public function transformCamelCase(string $string) : string
    {
        return \lcfirst($this->transformUpperCamelCase($string));
    }

    /**
     * Match the route to the routes in the routing table, setting the $this->params property
     * if a route is found
     * 
     * @param string $url
     * @return bool
     */
    private function match(string $url) : bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $param) {
                    if (is_string($key)) {
                        $params[$key] = $param;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }


}