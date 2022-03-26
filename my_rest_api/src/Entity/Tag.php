<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Tag
 *
 * @ORM\Table(name="tag", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 * @ApiResource(
 *   attributes={"route_prefix"="/album"}
 *)
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Photo", mappedBy="idTag")
     */
    private $idPhoto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPhoto = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * @return Collection<int, Photo>
     */
    public function getIdPhoto(): Collection
    {
        return $this->idPhoto;
    }

    public function addIdPhoto(Photo $idPhoto): self
    {
        if (!$this->idPhoto->contains($idPhoto)) {
            $this->idPhoto[] = $idPhoto;
            $idPhoto->addIdTag($this);
        }

        return $this;
    }

    public function removeIdPhoto(Photo $idPhoto): self
    {
        if ($this->idPhoto->removeElement($idPhoto)) {
            $idPhoto->removeIdTag($this);
        }

        return $this;
    }

}
