<?php
use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    // Configure Twig
    Environment::class => function () {
        $loader = new FilesystemLoader([__DIR__ . '/../src/Pich', __DIR__ . '/layout']);
        return new Environment(
            $loader
//            ['cache' => __DIR__ . '/../var/cache/twig']
        );
    },
];
