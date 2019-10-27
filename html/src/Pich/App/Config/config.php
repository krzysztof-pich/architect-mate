<?php

return [
    'PDO' => function (\Psr\Container\ContainerInterface $c) {
        return new PDO(
            "mysql:host=mysql;dbname=architect_mate;port=3306", 'root', 'root'
//            "mysql:host={$c->get('db.host')};dbname={$c->get('db.database')}",
//            $c->get('db.user'),
//            $c->get('db.password')
        );
    },
    'Database' => Di\create(\Pich\App\Database::class)
        ->constructor(DI\get('PDO')),
    'WebKernel' => Di\create(\Pich\App\WebKernel::class)
        ->constructor(Di\get('Dispatcher'))
];
