<?php

namespace Pich\App\Tests;

use Pich\App\PasswordHash;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordHashAndVerify(): void
    {
        $password = 'qwerty';
        $passwordHash = new PasswordHash();
        $hash = $passwordHash->createPasswordHash($password);
        $this->assertTrue($passwordHash->verifyPassword($password, $hash), 'Password can\'t be verified');
    }
}
