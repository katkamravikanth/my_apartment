<?php

namespace App\Entity;

use App\Repository\TenantRepository;
use App\Security\UserInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TenantRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class Tenant implements UserInterface, PasswordAuthenticatedUserInterface
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
    #[Assert\Length(max: 20, maxMessage: 'Your address cannot be longer than {{ limit }} characters')]
    private ?string $address = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(max: 18, maxMessage: 'Your aadhaar number cannot be longer than {{ limit }} characters')]
    private ?string $aadhaarNo = null;

    #[ORM\Column(length: 10)]
    #[Assert\Length(max: 8, maxMessage: 'Your floor number cannot be longer than {{ limit }} characters')]
    private ?string $floorNo = null;

    #[ORM\Column(length: 10)]
    #[Assert\Length(max: 20, maxMessage: 'Your unit number cannot be longer than {{ limit }} characters')]
    private ?string $unitNo = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $advanceRent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $rentPerMonth = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $issueDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $exitDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $month = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\ManyToOne(inversedBy: 'tenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Branch $branch = null;

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
        $roles[] = 'ROLE_TENANT';
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

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

    public function getFloorNo(): ?string
    {
        return $this->floorNo;
    }

    public function setFloorNo(string $floorNo): static
    {
        $this->floorNo = $floorNo;

        return $this;
    }

    public function getUnitNo(): ?string
    {
        return $this->unitNo;
    }

    public function setUnitNo(string $unitNo): static
    {
        $this->unitNo = $unitNo;

        return $this;
    }

    public function getAdvanceRent(): ?string
    {
        return $this->advanceRent;
    }

    public function setAdvanceRent(string $advanceRent): static
    {
        $this->advanceRent = $advanceRent;

        return $this;
    }

    public function getRentPerMonth(): ?string
    {
        return $this->rentPerMonth;
    }

    public function setRentPerMonth(string $rentPerMonth): static
    {
        $this->rentPerMonth = $rentPerMonth;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(\DateTimeInterface $issueDate): static
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public function getExitDate(): ?\DateTimeInterface
    {
        return $this->exitDate;
    }

    public function setExitDate(?\DateTimeInterface $exitDate): static
    {
        $this->exitDate = $exitDate;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): static
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

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
}
