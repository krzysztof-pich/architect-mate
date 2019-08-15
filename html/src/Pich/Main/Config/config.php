<?php

return [
    'WebKernel' => Di\create(\Pich\App\WebKernel::class)
        ->constructor(Di\get('Dispatcher'))
];
