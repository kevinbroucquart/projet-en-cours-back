<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ApiResource(
 *              normalizationContext={"groups"={"users_read"}},
 *              denormalizationContext={"groups"={"users_write"}}
 *                       
 * )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"users_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @groups({"users_read", "users_write"})
     * @Assert\NotBlank(message="l'email est obligatoire")
     * @Assert\Email(message= "l'email doit être valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @groups({"users_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @groups({"users_write"})
     * @Assert\NotBlank(message="le mot de passe est obligatoire")
     * @Assert\Length(min=8, minMessage="Le mot de passe doit faire au minimum 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @groups({"users_write"})
     * 
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=GlobalPropertyAttribute::class, mappedBy="relation")
     */
    private $globalPropertyAttributes;

    public function __construct()
    {
        $this->globalPropertyAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|GlobalPropertyAttribute[]
     */
    public function getGlobalPropertyAttributes(): Collection
    {
        return $this->globalPropertyAttributes;
    }

    public function addGlobalPropertyAttribute(GlobalPropertyAttribute $globalPropertyAttribute): self
    {
        if (!$this->globalPropertyAttributes->contains($globalPropertyAttribute)) {
            $this->globalPropertyAttributes[] = $globalPropertyAttribute;
            $globalPropertyAttribute->setRelation($this);
        }

        return $this;
    }

    public function removeGlobalPropertyAttribute(GlobalPropertyAttribute $globalPropertyAttribute): self
    {
        if ($this->globalPropertyAttributes->contains($globalPropertyAttribute)) {
            $this->globalPropertyAttributes->removeElement($globalPropertyAttribute);
            // set the owning side to null (unless already changed)
            if ($globalPropertyAttribute->getRelation() === $this) {
                $globalPropertyAttribute->setRelation(null);
            }
        }

        return $this;
    }
}
