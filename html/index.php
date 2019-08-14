<?php declare(strict_types=1);

use FastRoute\RouteCollector;
/** @var \DI\Container $container */
$container = require __DIR__ . '/src/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'Pich\Main\Controller\Index');
    $r->addRoute('GET', '/repository', 'Pich\Repository\Controller\Index');
});
$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        echo $container->get($controller)->execute($parameters);
        break;
}
