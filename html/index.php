<?php declare(strict_types=1);

use FastRoute\RouteCollector;
/** @var \DI\Container $container */
$container = require __DIR__ . '/app/bootstrap.php';

/** @var \Pich\App\WebKernel $webKernel */
$webKernel = $container->get('WebKernel');
$response = $webKernel->execute();
foreach ($response->getHeaders() as $header) {
    header($header);
}
http_response_code($response->getStatus());
echo $response->render();
