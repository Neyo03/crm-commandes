<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Rattachement>
     */
    #[ORM\OneToMany(targetEntity: Rattachement::class, mappedBy: 'region', cascade: ['persist', 'remove'])]
    private Collection $rattachements;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'regions')]
    private Collection $users;

    public function __construct()
    {
        $this->rattachements = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    /**
     * @return Collection<int, Rattachement>
     */
    public function getRattachements(): Collection
    {
        return $this->rattachements;
    }

    public function addRattachement(Rattachement $rattachement): static
    {
        if (!$this->rattachements->contains($rattachement)) {
            $this->rattachements->add($rattachement);
            $rattachement->setRegion($this);
        }

        return $this;
    }

    public function removeRattachement(Rattachement $rattachement): static
    {
        if ($this->rattachements->removeElement($rattachement)) {
            // set the owning side to null (unless already changed)
            if ($rattachement->getRegion() === $this) {
                $rattachement->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }
}
