<?php

namespace App\Entity;

use App\Repository\SuperAdminRepository;
use App\Security\UserInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class SuperAdmin implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length:180)]
    #[Assert\NotBlank(message: "Name should not be blank.")]
    #[Assert\Length(max: 175, maxMessage: 'Your name cannot be longer than {{ limit }} characters')]
    private ?string $name = null;

    #[ORM\Column(length:25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your contact cannot be longer than {{ limit }} characters')]
    private ?string $contact = null;

    #[ORM\Column(length:180, unique:true)]
    #[Assert\NotBlank(message: "Email should not be blank.")]
    #[Assert\Email(message: 'The email {{ value }} is not a valid email.')]
    private ?string $email = null;

    #[ORM\Column(type: Types::JSON)]
    private $roles = [];

    #[ORM\Column]
    #[Assert\NotBlank(message: "Password should not be blank.")]
    #[Assert\Length(min: 8, minMessage: 'Your password must be at least {{ limit }} characters long')]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getUsername(): string
    {
        return (string)$this->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every super admin at least has ROLE_SUPER_ADMIN
        $roles[] = 'ROLE_SUPER_ADMIN';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getSalt(): ?string
    {
        // not needed when using modern encoders
        return null;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data, clear it here
    }
}
