<?php declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

$mainRoute = new \Symfony\Component\Routing\Route(
    '/{id}',
    array('controller' => \Pich\Main\Controller\Index::class)
);

$routes = new \Symfony\Component\Routing\RouteCollection();
$routes->add('main', $mainRoute);

// Init RequestContext object
$context = new \Symfony\Component\Routing\RequestContext();
$context->fromRequest(Symfony\Component\HttpFoundation\Request::createFromGlobals());

// Init UrlMatcher object
$matcher = new Symfony\Component\Routing\Matcher\UrlMatcher($routes, $context);

// Find the current route
$parameters = $matcher->match($context->getPathInfo());


$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
var_dump($parameters);
