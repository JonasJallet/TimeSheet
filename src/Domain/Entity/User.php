<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[UniqueEntity(fields: ['email'], message: 'Exceptions.Assert.Unique', payload: [
    'value' => 'value',
    'property' => 'email',
    'entity' => 'User',
])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::STRING)]
    private string $password;

    #[ORM\OneToOne(targetEntity: WorkHourDefault::class, inversedBy: 'user')]
    private ?WorkHourDefault $defaultWorkHour = null;

    #[ORM\OneToMany(targetEntity: TimeSheet::class, mappedBy: 'user')]
    private Collection $timeSheets;

    public function __construct()
    {
        $this->timeSheets = new ArrayCollection();
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDefaultWorkHour(): ?WorkHourDefault
    {
        return $this->defaultWorkHour;
    }

    public function setDefaultWorkHour(?WorkHourDefault $defaultWorkHour): static
    {
        $this->defaultWorkHour = $defaultWorkHour;

        return $this;
    }

    /**
     * @return Collection<int, TimeSheet>
     */
    public function getTimeSheets(): Collection
    {
        return $this->timeSheets;
    }

    public function addTimeSheet(TimeSheet $timeSheet): self
    {
        if (!$this->timeSheets->contains($timeSheet)) {
            $this->timeSheets->add($timeSheet);
            $timeSheet->setUser($this);
        }

        return $this;
    }
}
