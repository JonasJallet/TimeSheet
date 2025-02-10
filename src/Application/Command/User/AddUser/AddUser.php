<?php

namespace App\Application\Command\User\AddUser;

use App\Application\Bus\Command\Command;
use App\Domain\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class AddUser implements Command
{
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
        payload: [
            "property" => "firstName",
            "entity" => User::class,
        ]
    )]
    public string $firstName;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
        payload: [
            "property" => "lastName",
            "entity" => User::class,
        ]
    )]
    public string $lastName;

    #[Assert\NotBlank(
        message: "Exceptions.Assert.NotBlank",
        payload: [
            "property" => "password",
            "entity" => User::class,
        ]
    )]
    public string $password;

    public function toEntity(): User
    {
        $addUser = new User();
        $addUser
            ->setEmail($this->email)
            ->setFirstName($this->firstName)
            ->setLastName($this->lastName)
            ->setPassword($this->password);

        return $addUser;
    }
}
