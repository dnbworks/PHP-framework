<?php

$route = '/{user}/index/{id:2}';

$route = preg_replace('/\//', '\\', $route);

// Convert variables e.g. {controller}
$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

// Convert variables with custom regular expressions e.g. {id:\d+}
$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

// Add start and end delimiters, and case insensitive flag
$route = '/^' . $route . '$/i';

$routes = [
    "/^\(?P<user>[a-z-]+)\index\(?P<id>2)$/i" => ["params" => 1]
];


// echo $route;
$url = "/^\(?P<user>[a-z-]+)\index\(?P<id>2)$/i";

foreach ($routes as $route => $params) {
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
 
print_r($matches);