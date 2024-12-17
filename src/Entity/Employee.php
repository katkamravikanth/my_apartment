<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use App\Security\UserInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class Employee implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 250, maxMessage: 'Your present address cannot be longer than {{ limit }} characters')]
    private ?string $presentAddress = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 250, maxMessage: 'Your permanent address cannot be longer than {{ limit }} characters')]
    private ?string $permanentAddress = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(max: 18, maxMessage: 'Your aadhaar number cannot be longer than {{ limit }} characters')]
    private ?string $aadhaarNo = null;

    #[ORM\OneToOne(inversedBy: 'employee', cascade: ['persist', 'remove'])]
    private ?MemberType $designation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $joiningDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endingDate = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToOne(inversedBy: 'employee', cascade: ['persist', 'remove'])]
    private ?Branch $branch = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $salary = null;

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
        $roles[] = 'ROLE_EMPLOYEE';
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

    public function getPresentAddress(): ?string
    {
        return $this->presentAddress;
    }

    public function setPresentAddress(string $presentAddress): static
    {
        $this->presentAddress = $presentAddress;

        return $this;
    }

    public function getPermanentAddress(): ?string
    {
        return $this->permanentAddress;
    }

    public function setPermanentAddress(string $permanentAddress): static
    {
        $this->permanentAddress = $permanentAddress;

        return $this;
    }

    public function getAadhaarNo(): ?string
    {
        return $this->aadhaarNo;
    }

    public function setAadhaarNo(?string $aadhaarNo): static
    {
        $this->aadhaarNo = $aadhaarNo;

        return $this;
    }

    public function getDesignation(): ?MemberType
    {
        return $this->designation;
    }

    public function setDesignation(MemberType $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getJoiningDate(): ?\DateTimeInterface
    {
        return $this->joiningDate;
    }

    public function setJoiningDate(\DateTimeInterface $joiningDate): static
    {
        $this->joiningDate = $joiningDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(?\DateTimeInterface $endingDate): static
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): static
    {
        $this->branch = $branch;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): static
    {
        $this->salary = $salary;

        return $this;
    }
}
