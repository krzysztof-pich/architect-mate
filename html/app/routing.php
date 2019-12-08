<?php
return [
    'IndexRoute'  => Di\create(\Pich\App\Router\Route::class)
        ->constructor('GET', '/', Di\get(\Pich\Main\Action\Index::class)),
    'RepositoryAddRoute' => Di\create(\Pich\App\Router\Route::class)
        ->constructor('POST', '/vcs/repository', Di\get(\Pich\Repository\Action\Add::class)),
    'RepositoryGridRoute' => Di\create(\Pich\App\Router\Route::class)
        ->constructor('GET', '/vcs/repository', Di\get(\Pich\Repository\Action\Grid::class)),
    'Dispatcher'  => Di\create(\Pich\App\Router\Dispatcher::class)
        ->method('addRoute', Di\get('IndexRoute'))
        ->method('addRoute', Di\get('RepositoryAddRoute'))
        ->method('addRoute', Di\get('RepositoryGridRoute')),
];

