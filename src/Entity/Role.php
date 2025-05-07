<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\Camp;


#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', enumType: Camp::class)]
    private ?Camp $camp = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $goal = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $minPlayer = null;

    /**
     * @var Collection<int, Power>
     */
    #[ORM\OneToMany(targetEntity: Power::class, mappedBy: 'role', orphanRemoval: true)]
    private Collection $powers;

    public function __construct()
    {
        $this->powers = new ArrayCollection();
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

    public function getCamp(): ?Camp
    {
        return $this->camp;
    }

    public function setCamp(Camp $camp): static
    {
        $this->camp = $camp;
        return $this;
    }


    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMinPlayer(): ?int
    {
        return $this->minPlayer;
    }

    public function setMinPlayer(int $minPlayer): static
    {
        $this->minPlayer = $minPlayer;

        return $this;
    }

    /**
     * @return Collection<int, Power>
     */
    public function getPowers(): Collection
    {
        return $this->powers;
    }

    public function addPower(Power $power): static
    {
        if (!$this->powers->contains($power)) {
            $this->powers->add($power);
            $power->setRole($this);
        }

        return $this;
    }

    public function removePower(Power $power): static
    {
        if ($this->powers->removeElement($power)) {
            // set the owning side to null (unless already changed)
            if ($power->getRole() === $this) {
                $power->setRole(null);
            }
        }

        return $this;
    }
}
