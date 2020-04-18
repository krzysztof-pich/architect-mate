<?php
return [
    \Pich\User\Domain\Jwt::class =>  function (\Psr\Container\ContainerInterface $c) {
        return new \Pich\User\Domain\Jwt((string)$c->get('jwt'));
    }
];
