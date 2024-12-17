<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BranchRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class Branch
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Name should not be blank.")]
    #[Assert\Length(max: 250, maxMessage: 'Your name cannot be longer than {{ limit }} characters')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(max: 20, maxMessage: 'Your contact number cannot be longer than {{ limit }} characters')]
    private ?string $contactNo = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 250, maxMessage: 'Your address cannot be longer than {{ limit }} characters')]
    private ?string $address = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your security guard contact mobile cannot be longer than {{ limit }} characters')]
    private ?string $securityGuardMobile = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your secretary mobile cannot be longer than {{ limit }} characters')]
    private ?string $secretaryMobile = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your moderator mobile cannot be longer than {{ limit }} characters')]
    private ?string $moderatorMobile = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your building make year cannot be longer than {{ limit }} characters')]
    private ?string $buildingMakeYear = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $buildingImage = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 250, maxMessage: 'Your builder company name cannot be longer than {{ limit }} characters')]
    private ?string $builderCompanyName = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Your builder company phone cannot be longer than {{ limit }} characters')]
    private ?string $builderCompanyPhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 250, maxMessage: 'Your builder company address cannot be longer than {{ limit }} characters')]
    private ?string $builderCompanyAddress = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $buildingRule = null;

    #[ORM\OneToOne(mappedBy: 'branch', cascade: ['persist', 'remove'])]
    private ?Admin $admin = null;

    #[ORM\OneToOne(mappedBy: 'branch', cascade: ['persist', 'remove'])]
    private ?Employee $employee = null;

    #[ORM\OneToOne(mappedBy: 'branch', cascade: ['persist', 'remove'])]
    private ?Owner $owner = null;

    /**
     * @var Collection<int, Tenant>
     */
    #[ORM\OneToMany(targetEntity: Tenant::class, mappedBy: 'branch', orphanRemoval: true)]
    private Collection $tenants;

    public function __construct()
    {
        $this->tenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContactNo(): ?string
    {
        return $this->contactNo;
    }

    public function setContactNo(string $contactNo): static
    {
        $this->contactNo = $contactNo;

        return $this;
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

    public function getSecurityGuardMobile(): ?string
    {
        return $this->securityGuardMobile;
    }

    public function setSecurityGuardMobile(?string $securityGuardMobile): static
    {
        $this->securityGuardMobile = $securityGuardMobile;

        return $this;
    }

    public function getSecretaryMobile(): ?string
    {
        return $this->secretaryMobile;
    }

    public function setSecretaryMobile(?string $secretaryMobile): static
    {
        $this->secretaryMobile = $secretaryMobile;

        return $this;
    }

    public function getModeratorMobile(): ?string
    {
        return $this->moderatorMobile;
    }

    public function setModeratorMobile(?string $moderatorMobile): static
    {
        $this->moderatorMobile = $moderatorMobile;

        return $this;
    }

    public function getBuildingMakeYear(): ?string
    {
        return $this->buildingMakeYear;
    }

    public function setBuildingMakeYear(?string $buildingMakeYear): static
    {
        $this->buildingMakeYear = $buildingMakeYear;

        return $this;
    }

    public function getBuildingImage(): ?string
    {
        return $this->buildingImage;
    }

    public function setBuildingImage(?string $buildingImage): static
    {
        $this->buildingImage = $buildingImage;

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

    public function getBuilderCompanyName(): ?string
    {
        return $this->builderCompanyName;
    }

    public function setBuilderCompanyName(?string $builderCompanyName): static
    {
        $this->builderCompanyName = $builderCompanyName;

        return $this;
    }

    public function getBuilderCompanyPhone(): ?string
    {
        return $this->builderCompanyPhone;
    }

    public function setBuilderCompanyPhone(?string $builderCompanyPhone): static
    {
        $this->builderCompanyPhone = $builderCompanyPhone;

        return $this;
    }

    public function getBuilderCompanyAddress(): ?string
    {
        return $this->builderCompanyAddress;
    }

    public function setBuilderCompanyAddress(?string $builderCompanyAddress): static
    {
        $this->builderCompanyAddress = $builderCompanyAddress;

        return $this;
    }

    public function getBuildingRule(): ?string
    {
        return $this->buildingRule;
    }

    public function setBuildingRule(?string $buildingRule): static
    {
        $this->buildingRule = $buildingRule;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(Admin $admin): static
    {
        // set the owning side of the relation if necessary
        if ($admin->getBranch() !== $this) {
            $admin->setBranch($this);
        }

        $this->admin = $admin;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        // unset the owning side of the relation if necessary
        if ($employee === null && $this->employee !== null) {
            $this->employee->setBranch(null);
        }

        // set the owning side of the relation if necessary
        if ($employee !== null && $employee->getBranch() !== $this) {
            $employee->setBranch($this);
        }

        $this->employee = $employee;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): static
    {
        // unset the owning side of the relation if necessary
        if ($owner === null && $this->owner !== null) {
            $this->owner->setBranch(null);
        }

        // set the owning side of the relation if necessary
        if ($owner !== null && $owner->getBranch() !== $this) {
            $owner->setBranch($this);
        }

        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Tenant>
     */
    public function getTenants(): Collection
    {
        return $this->tenants;
    }

    public function addTenant(Tenant $tenant): static
    {
        if (!$this->tenants->contains($tenant)) {
            $this->tenants->add($tenant);
            $tenant->setBranch($this);
        }

        return $this;
    }

    public function removeTenant(Tenant $tenant): static
    {
        if ($this->tenants->removeElement($tenant)) {
            // set the owning side to null (unless already changed)
            if ($tenant->getBranch() === $this) {
                $tenant->setBranch(null);
            }
        }

        return $this;
    }
}
