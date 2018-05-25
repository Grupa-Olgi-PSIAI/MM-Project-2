<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contractor
 *
 * @ORM\Table(name="contractors")
 * @ORM\Entity
 */
class Contractor
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
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="vat_id", type="string", length=20, nullable=false)
     */
    private $vatId;

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
     * @return Contractor
     */
    public function setId(int $id): Contractor
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
     * @return Contractor
     */
    public function setDateCreated(\DateTime $dateCreated): Contractor
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
     * @return Contractor
     */
    public function setLastUpdated(\DateTime $lastUpdated): Contractor
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Contractor
     */
    public function setName(string $name): Contractor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatId(): ?string
    {
        return $this->vatId;
    }

    /**
     * @param string $vatId
     * @return Contractor
     */
    public function setVatId(string $vatId): Contractor
    {
        $this->vatId = $vatId;
        return $this;
    }
}

