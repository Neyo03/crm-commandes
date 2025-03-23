<?php

namespace App\Entity;

use App\Entity\Trait\PermissionTrait;
use App\EventListener\EntityDeleteListener;
use App\Repository\UserRepository;
use App\Security\Enum\PermissionEnum;
use App\Security\Enum\RoleEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[HasLifecycleCallbacks]
#[ORM\EntityListeners([EntityDeleteListener::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    use PermissionTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $permissions = [];

    #[ORM\Column]
    private ?bool $isFirstLogin = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $loginLink = null;

    /**
     * @var Collection<int, Rattachement>
     */
    #[ORM\ManyToMany(targetEntity: Rattachement::class, mappedBy: 'users')]
    private Collection $rattachements;

    /**
     * @var Collection<int, Region>
     */
    #[ORM\ManyToMany(targetEntity: Region::class, mappedBy: 'users')]
    private Collection $regions;

    public function __construct()
    {
        $this->rattachements = new ArrayCollection();
        $this->regions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role The role to check.
     * @return bool True if the user has the role, false otherwise.
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles());
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): self
    {
        $this->permissions = $permissions;
        return $this;
    }

    public function hasPermission(PermissionEnum $permission): bool
    {
        return in_array($permission->value, $this->permissions);
    }

    public function isSuperAdmin(): bool
    {
        return in_array(RoleEnum::ROLE_SUPER_ADMIN->value, $this->roles);
    }

    public function isFirstLogin(): ?bool
    {
        return $this->isFirstLogin;
    }

    public function setIsFirstLogin(bool $isFirstLogin): static
    {
        $this->isFirstLogin = $isFirstLogin;

        return $this;
    }

    #[ORM\PrePersist]
    public function onPrepersist(): void
    {
        $this->isFirstLogin = true;
    }

    public function getLoginLink(): ?string
    {
        return $this->loginLink;
    }

    public function setLoginLink(?string $loginLink): static
    {
        $this->loginLink = $loginLink;

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
            $rattachement->addUser($this);
        }

        return $this;
    }

    public function removeRattachement(Rattachement $rattachement): static
    {
        if ($this->rattachements->removeElement($rattachement)) {
            $rattachement->removeUser($this);
        }

        return $this;
    }

    public function getRegions(): ?Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): static
    {
        if (!$this->regions->contains($region)) {
            $this->regions->add($region);
            $region->addUser($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): static
    {
        if ($this->regions->removeElement($region)) {
            $region->removeUser($this);
        }

        return $this;
    }
}
