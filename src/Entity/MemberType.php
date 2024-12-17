<?php

namespace App\Entity;

use App\Repository\MemberTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MemberTypeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false)]
class MemberType
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Member type should not be blank.")]
    #[Assert\Length(max: 250, maxMessage: 'Your member type cannot be longer than {{ limit }} characters')]
    private ?string $memberType = null;

    #[ORM\OneToOne(mappedBy: 'designationType', cascade: ['persist', 'remove'])]
    private ?Employee $employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMemberType(): ?string
    {
        return $this->memberType;
    }

    public function setMemberType(string $memberType): static
    {
        $this->memberType = $memberType;

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
            $this->employee->setDesignationType(null);
        }

        // set the owning side of the relation if necessary
        if ($employee !== null && $employee->getDesignationType() !== $this) {
            $employee->setDesignationType($this);
        }

        $this->employee = $employee;

        return $this;
    }
}
