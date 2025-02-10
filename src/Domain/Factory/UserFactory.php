<?php

namespace App\Domain\Factory;

use App\Domain\Entity\User;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
class UserFactory extends PersistentProxyObjectFactory
{
    public const string PASSWORD = "password";

    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->unique()->email(),
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'password' => self::PASSWORD,
            'defaultWorkHour' => WorkHourDefaultFactory::new(),
            ];
    }

    public static function class(): string
    {
        return User::class;
    }
}
