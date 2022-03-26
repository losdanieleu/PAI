<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   denormalizationContext={"groups" = {"write"}},
 *   attributes={"route_prefix"="/album"},
 *   itemOperations={"get", "delete"}
 * )
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     * @Groups({"read", "write"})
     */
    private $password;

    /**
     * @var \DateTime
     *------------------------------------------------ DODAJ NIZEJ ABY POKAZAC,"write"
     * @Groups({"read","write"})   
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="DateTime('now')"})  
     */
    private $createdAt = 'current_timestamp()';

    /**
     * @var \DateTime
     *  ------------------------------------------------ DODAJ NIZEJ ABY POKAZAC,"write"
     * @Groups({"read","write"})
     * @ORM\Column(name="last_login", type="datetime", nullable=false, options={"default"="DateTime('now')"})
     */
    private $lastLogin = 'current_timestamp()';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


/**
     * Prepersist gets triggered on Insert
     * @ORM\PrePersist
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
	if ($this->createdAt == null) {
            $this->createdAt = new \DateTime('now');
        }
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {

	 $this->createdAt = $createdAt;

        return $this;
    }
/**
     * Prepersist gets triggered on Insert
     * @ORM\PrePersist
     */
    public function getLastLogin(): ?\DateTimeInterface
    {

	if ($this->lastLogin == null) {
            $this->lastLogin = new \DateTime('now');
        }
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {

        $this->lastLogin = $lastLogin;

        return $this;
    }


}