<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="files")
 * @ORM\Entity
 */
class File
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=false)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=false)
     */
    private $lastUpdated;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=false)
     */
    private $category;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="size", type="integer", nullable=true)
     */
    private $size;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=128, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->lastUpdated = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onPreUpdate()
    {
        $this->lastUpdated = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return File
     */
    public function setId(int $id): File
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     * @return File
     */
    public function setDateCreated(\DateTime $dateCreated): File
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdated(): \DateTime
    {
        return $this->lastUpdated;
    }

    /**
     * @param \DateTime $lastUpdated
     * @return File
     */
    public function setLastUpdated(\DateTime $lastUpdated): File
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return File
     */
    public function setName(?string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return File
     */
    public function setCategory(string $category): File
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     * @return File
     */
    public function setSize(?int $size): File
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     * @return File
     */
    public function setType(?string $type): File
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return File
     */
    public function setPath(string $path): File
    {
        $this->path = $path;
        return $this;
    }
}

