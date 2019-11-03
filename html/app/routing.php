<?php
return [
    'IndexRoute'  => Di\create(\Pich\App\Router\Route::class)
        ->constructor('GET', '/', Di\get(\Pich\Main\Action\Index::class)),
    'AddVcsRoute' => Di\create(\Pich\App\Router\Route::class)
        ->constructor('GET', '/vcs/create', Di\get(\Pich\Vcs\Action\Add::class)),
    'Dispatcher'  => Di\create(\Pich\App\Router\Dispatcher::class)
        ->method('addRoute', Di\get('IndexRoute'))
        ->method('addRoute', Di\get('AddVcsRoute')),
];

