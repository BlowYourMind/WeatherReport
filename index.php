<?php
require 'C:\Users\maksi\PhpstormProjects\untitled4\vendor\autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\WeatherController@show');


    // {id} must be a nphp umber (\d+)
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        var_dump("Error");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        var_dump("Yes");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = explode("@", $handler);
        $loader = new \Twig\Loader\FilesystemLoader('app\Views');
        $twig = new \Twig\Environment($loader);
        $view = (new $controller)->$method();
        $template = $twig->load($view->getTemplatePath());
        echo $template->render($view->getData());

        break;
}

//file get content  use TWIG