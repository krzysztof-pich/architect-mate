<?php
/**
 * The bootstrap file creates and returns the container.
 */
use DI\ContainerBuilder;
require __DIR__ . '/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$containerBuilder->addDefinitions(__DIR__ . '/routing.php');
$containerBuilder->addDefinitions(__DIR__ . '/../src/Pich/App/Config/config.php');
return $containerBuilder->build();
