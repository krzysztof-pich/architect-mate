<?php declare(strict_types=1);

namespace Pich\App;

class PasswordHash
{
    public function createPasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
