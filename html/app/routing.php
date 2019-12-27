<?php
return [
    'Dispatcher'  => Di\create(\Pich\App\Router\Dispatcher::class)
        ->method(
            'addRoute',
            Di\create(\Pich\App\Router\Route::class)
                ->constructor('POST', '/user', Di\get(\Pich\User\Action\Register::class))
        )
        ->method(
            'addRoute',
            Di\create(\Pich\App\Router\Route::class)
                ->constructor('POST', '/vcs/repository', Di\get(\Pich\Vcs\Action\Add::class))
        )
        ->method(
            'addRoute',
            Di\create(\Pich\App\Router\Route::class)
                ->constructor('GET', '/vcs/repository', Di\get(\Pich\Vcs\Action\Grid::class))
        ),
];

