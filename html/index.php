<?php declare(strict_types=1);

use FastRoute\RouteCollector;
/** @var \DI\Container $container */
$container = require __DIR__ . '/app/bootstrap.php';

$container->get('WebKernel')->execute();
