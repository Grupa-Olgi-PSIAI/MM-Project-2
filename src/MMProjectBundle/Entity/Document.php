<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table(name="documents", indexes={@ORM\Index(name="documents_contractor_id_fkey", columns={"contractor_id"}), @ORM\Index(name="documents_files_id_fk", columns={"file_id"})})
 * @ORM\Entity(repositoryClass="MMProjectBundle\Repository\DocumentRepository")
 */
class Document
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
     * @ORM\Column(name="id_internal", type="string", length=100, nullable=false)
     */
    private $idInternal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \MMProjectBundle\Entity\Contractor
     *
     * @ORM\ManyToOne(targetEntity="Contractor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contractor_id", referencedColumnName="id")
     * })
     */
    private $contractor;

    /**
     * @var \MMProjectBundle\Entity\File
     *
     * @ORM\ManyToOne(targetEntity="File")
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
     * @return Document
     */
    public function setId(int $id): Document
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
     * @return Document
     */
    public function setDateCreated(\DateTime $dateCreated): Document
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
     * @return Document
     */
    public function setLastUpdated(\DateTime $lastUpdated): Document
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdInternal(): ?string
    {
        return $this->idInternal;
    }

    /**
     * @param string $idInternal
     * @return Document
     */
    public function setIdInternal(string $idInternal): Document
    {
        $this->idInternal = $idInternal;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Document
     */
    public function setDescription(?string $description): Document
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Contractor
     */
    public function getContractor(): ?Contractor
    {
        return $this->contractor;
    }

    /**
     * @param Contractor $contractor
     * @return Document
     */
    public function setContractor(Contractor $contractor): Document
    {
        $this->contractor = $contractor;
        return $this;
    }

    /**
     * @return File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return Document
     */
    public function setFile(File $file): Document
    {
        $this->file = $file;
        return $this;
    }
}

