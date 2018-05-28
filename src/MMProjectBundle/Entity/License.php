<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * License
 *
 * @ORM\Table(name="licences", indexes={@ORM\Index(name="licence_user_id_fkey", columns={"user_id"}), @ORM\Index(name="licences_invoices_id_fk", columns={"invoice_id"})})
 * @ORM\Entity(repositoryClass="MMProjectBundle\Repository\LicenseRepository")
 *
 * @Vich\Uploadable
 */
class License
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
     * @ORM\Column(name="inventory_number", type="string", length=50, nullable=false)
     */
    private $inventoryNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="serial_key", type="string", length=50, nullable=false)
     */
    private $serialKey;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="validation_date", type="datetime", nullable=false)
     */
    private $validationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="tech_support_end_date", type="datetime", nullable=true)
     */
    private $techSupportEndDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @var \MMProjectBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="file", fileNameProperty="embeddedFile.name", size="embeddedFile.size", mimeType="embeddedFile.mimeType", originalName="embeddedFile.originalName")
     */
    private $file;

    /**
     * @var EmbeddedFile
     *
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     */
    private $embeddedFile;

    /**
     * @var \MMProjectBundle\Entity\Invoice
     *
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     * })
     */
    private $invoice;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->lastUpdated = new \DateTime();
        $this->embeddedFile = new EmbeddedFile();
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
     * @return License
     */
    public function setId(int $id): License
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
     * @return License
     */
    public function setDateCreated(\DateTime $dateCreated): License
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
     * @return License
     */
    public function setLastUpdated(\DateTime $lastUpdated): License
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getInventoryNumber(): ?string
    {
        return $this->inventoryNumber;
    }

    /**
     * @param string $inventoryNumber
     * @return License
     */
    public function setInventoryNumber(string $inventoryNumber): License
    {
        $this->inventoryNumber = $inventoryNumber;
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
     * @return License
     */
    public function setName(string $name): License
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialKey(): ?string
    {
        return $this->serialKey;
    }

    /**
     * @param string $serialKey
     * @return License
     */
    public function setSerialKey(string $serialKey): License
    {
        $this->serialKey = $serialKey;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidationDate(): ?\DateTime
    {
        return $this->validationDate;
    }

    /**
     * @param \DateTime $validationDate
     * @return License
     */
    public function setValidationDate(\DateTime $validationDate): License
    {
        $this->validationDate = $validationDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getTechSupportEndDate(): ?\DateTime
    {
        return $this->techSupportEndDate;
    }

    /**
     * @param \DateTime|null $techSupportEndDate
     * @return License
     */
    public function setTechSupportEndDate(?\DateTime $techSupportEndDate): License
    {
        $this->techSupportEndDate = $techSupportEndDate;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPurchaseDate(): ?\DateTime
    {
        return $this->purchaseDate;
    }

    /**
     * @param \DateTime|null $purchaseDate
     * @return License
     */
    public function setPurchaseDate(?\DateTime $purchaseDate): License
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param null|string $notes
     * @return License
     */
    public function setNotes(?string $notes): License
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return License
     */
    public function setUser(User $user): License
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|UploadedFile $file
     * @return License
     */
    public function setFile(File $file = null): License
    {
        $this->file = $file;
        if ($file) {
            $this->lastUpdated = new \DateTime();
        }

        return $this;
    }

    /**
     * @return EmbeddedFile
     */
    public function getEmbeddedFile(): EmbeddedFile
    {
        return $this->embeddedFile;
    }

    /**
     * @param EmbeddedFile $embeddedFile
     * @return License
     */
    public function setEmbeddedFile(EmbeddedFile $embeddedFile): License
    {
        $this->embeddedFile = $embeddedFile;
        return $this;
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     * @return License
     */
    public function setInvoice(Invoice $invoice): License
    {
        $this->invoice = $invoice;
        return $this;
    }
}

