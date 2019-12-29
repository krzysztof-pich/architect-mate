<?php

return [
    'PDO' => function (\Psr\Container\ContainerInterface $c) {
        return new PDO(
            "mysql:host={$c->get('db.host')};dbname={$c->get('db.database')};port=3306", //'root', 'root',
            $c->get('db.user'),
            $c->get('db.password'),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    },
    'Database' => Di\create(\Pich\App\Database\ConnectionFactory::class)
        ->constructor(DI\get('PDO')),
    'WebKernel' => Di\create(\Pich\App\WebKernel::class)
        ->constructor(Di\get('Dispatcher'))
];
