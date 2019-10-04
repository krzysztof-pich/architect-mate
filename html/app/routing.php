<?php
return [
    'IndexRoute' => Di\create(\Pich\App\Router\Route::class)
        ->constructor('GET', '/', Di\get(\Pich\Main\Action\Index::class)),
    'Dispatcher' => Di\create(\Pich\App\Router\Dispatcher::class)
        ->method('addRoute', Di\get('IndexRoute')),

];

