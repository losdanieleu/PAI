<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Photo
 *
 * @ORM\Table(name="photo", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_album", columns={"id_album"})})
 * @ORM\Entity
 * @ApiResource(
 *   attributes={"route_prefix"="/album"}
 *)
 */
class Photo
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
     * @var string
     *
     * @ORM\Column(name="photo_path", type="text", length=65535, nullable=false)
     */
    private $photoPath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $createdAt = 'current_timestamp()';

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $views;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $likes;

    /**
     * @var \Album
     *
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_album", referencedColumnName="id")
     * })
     */
    private $idAlbum;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="idPhoto")
     * @ORM\JoinTable(name="tags",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_photo", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_tag", referencedColumnName="id")
     *   }
     * )
     */
    private $idTag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTag = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }

    public function setPhotoPath(string $photoPath): self
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getViews(): ?string
    {
        return $this->views;
    }

    public function setViews(string $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getIdAlbum(): ?Album
    {
        return $this->idAlbum;
    }

    public function setIdAlbum(?Album $idAlbum): self
    {
        $this->idAlbum = $idAlbum;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getIdTag(): Collection
    {
        return $this->idTag;
    }

    public function addIdTag(Tag $idTag): self
    {
        if (!$this->idTag->contains($idTag)) {
            $this->idTag[] = $idTag;
        }

        return $this;
    }

    public function removeIdTag(Tag $idTag): self
    {
        $this->idTag->removeElement($idTag);

        return $this;
    }

}
