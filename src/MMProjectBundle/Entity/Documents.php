<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="documents_contractor_id_fkey", columns={"contractor_id"}), @ORM\Index(name="documents_files_id_fk", columns={"file_id"})})
 * @ORM\Entity
 */
class Documents
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
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version;

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
     * @ORM\Column(name="id_internal", type="string", length=100, nullable=false)
     */
    private $idInternal;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \MMProjectBundle\Entity\Contractors
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Contractors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contractor_id", referencedColumnName="id")
     * })
     */
    private $contractor;

    /**
     * @var \MMProjectBundle\Entity\Files
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Files")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * })
     */
    private $file;

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
     * @return Documents
     */
    public function setId(int $id): Documents
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return Documents
     */
    public function setVersion(int $version): Documents
    {
        $this->version = $version;
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
     * @return Documents
     */
    public function setDateCreated(\DateTime $dateCreated): Documents
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
     * @return Documents
     */
    public function setLastUpdated(\DateTime $lastUpdated): Documents
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdInternal(): string
    {
        return $this->idInternal;
    }

    /**
     * @param string $idInternal
     * @return Documents
     */
    public function setIdInternal(string $idInternal): Documents
    {
        $this->idInternal = $idInternal;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Documents
     */
    public function setDescription(string $description): Documents
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Contractors
     */
    public function getContractor(): Contractors
    {
        return $this->contractor;
    }

    /**
     * @param Contractors $contractor
     * @return Documents
     */
    public function setContractor(Contractors $contractor): Documents
    {
        $this->contractor = $contractor;
        return $this;
    }

    /**
     * @return Files
     */
    public function getFile(): Files
    {
        return $this->file;
    }

    /**
     * @param Files $file
     * @return Documents
     */
    public function setFile(Files $file): Documents
    {
        $this->file = $file;
        return $this;
    }
}

