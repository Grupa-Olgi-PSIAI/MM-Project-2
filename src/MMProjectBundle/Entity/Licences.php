<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Licences
 *
 * @ORM\Table(name="licences", indexes={@ORM\Index(name="licence_user_id_fkey", columns={"user_id"}), @ORM\Index(name="licences_files_id_fk", columns={"file_id"}), @ORM\Index(name="licences_invoices_id_fk", columns={"invoice_id"})})
 * @ORM\Entity
 */
class Licences
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
     * @ORM\Column(name="inventory_number", type="string", length=50, nullable=false)
     */
    private $inventoryNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="serial_key", type="string", length=50, nullable=false)
     */
    private $serialKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validation_date", type="datetime", nullable=false)
     */
    private $validationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tech_support_end_date", type="datetime", nullable=true)
     */
    private $techSupportEndDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @var \MMProjectBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \MMProjectBundle\Entity\Files
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Files")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * })
     */
    private $file;

    /**
     * @var \MMProjectBundle\Entity\Invoices
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Invoices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     * })
     */
    private $invoice;

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
     * @return Licences
     */
    public function setId(int $id): Licences
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
     * @return Licences
     */
    public function setVersion(int $version): Licences
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
     * @return Licences
     */
    public function setDateCreated(\DateTime $dateCreated): Licences
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
     * @return Licences
     */
    public function setLastUpdated(\DateTime $lastUpdated): Licences
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getInventoryNumber(): string
    {
        return $this->inventoryNumber;
    }

    /**
     * @param string $inventoryNumber
     * @return Licences
     */
    public function setInventoryNumber(string $inventoryNumber): Licences
    {
        $this->inventoryNumber = $inventoryNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Licences
     */
    public function setName(string $name): Licences
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialKey(): string
    {
        return $this->serialKey;
    }

    /**
     * @param string $serialKey
     * @return Licences
     */
    public function setSerialKey(string $serialKey): Licences
    {
        $this->serialKey = $serialKey;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidationDate(): \DateTime
    {
        return $this->validationDate;
    }

    /**
     * @param \DateTime $validationDate
     * @return Licences
     */
    public function setValidationDate(\DateTime $validationDate): Licences
    {
        $this->validationDate = $validationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTechSupportEndDate(): \DateTime
    {
        return $this->techSupportEndDate;
    }

    /**
     * @param \DateTime $techSupportEndDate
     * @return Licences
     */
    public function setTechSupportEndDate(\DateTime $techSupportEndDate): Licences
    {
        $this->techSupportEndDate = $techSupportEndDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPurchaseDate(): \DateTime
    {
        return $this->purchaseDate;
    }

    /**
     * @param \DateTime $purchaseDate
     * @return Licences
     */
    public function setPurchaseDate(\DateTime $purchaseDate): Licences
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return Licences
     */
    public function setNotes(string $notes): Licences
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     * @return Licences
     */
    public function setUser(Users $user): Licences
    {
        $this->user = $user;
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
     * @return Licences
     */
    public function setFile(Files $file): Licences
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return Invoices
     */
    public function getInvoice(): Invoices
    {
        return $this->invoice;
    }

    /**
     * @param Invoices $invoice
     * @return Licences
     */
    public function setInvoice(Invoices $invoice): Licences
    {
        $this->invoice = $invoice;
        return $this;
    }
}

