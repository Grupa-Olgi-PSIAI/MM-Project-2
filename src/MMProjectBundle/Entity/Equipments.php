<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipments
 *
 * @ORM\Table(name="equipments", indexes={@ORM\Index(name="equipments_invoice_id_fkey", columns={"invoice_id"}), @ORM\Index(name="equipments_user_id_fkey", columns={"user_id"})})
 * @ORM\Entity
 */
class Equipments
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
     * @ORM\Column(name="serial_number", type="string", length=50, nullable=false)
     */
    private $serialNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validation_date", type="datetime", nullable=false)
     */
    private $validationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchase_date", type="datetime", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var float
     *
     * @ORM\Column(name="price_net", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceNet;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=65535, nullable=true)
     */
    private $notes;

    /**
     * @var \MMProjectBundle\Entity\Invoices
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Invoices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     * })
     */
    private $invoice;

    /**
     * @var \MMProjectBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

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
     * @return Equipments
     */
    public function setId(int $id): Equipments
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
     * @return Equipments
     */
    public function setVersion(int $version): Equipments
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
     * @return Equipments
     */
    public function setDateCreated(\DateTime $dateCreated): Equipments
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
     * @return Equipments
     */
    public function setLastUpdated(\DateTime $lastUpdated): Equipments
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
     * @return Equipments
     */
    public function setInventoryNumber(string $inventoryNumber): Equipments
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
     * @return Equipments
     */
    public function setName(string $name): Equipments
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     * @return Equipments
     */
    public function setSerialNumber(string $serialNumber): Equipments
    {
        $this->serialNumber = $serialNumber;
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
     * @return Equipments
     */
    public function setValidationDate(\DateTime $validationDate): Equipments
    {
        $this->validationDate = $validationDate;
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
     * @return Equipments
     */
    public function setPurchaseDate(\DateTime $purchaseDate): Equipments
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceNet(): float
    {
        return $this->priceNet;
    }

    /**
     * @param float $priceNet
     * @return Equipments
     */
    public function setPriceNet(float $priceNet): Equipments
    {
        $this->priceNet = $priceNet;
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
     * @return Equipments
     */
    public function setNotes(string $notes): Equipments
    {
        $this->notes = $notes;
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
     * @return Equipments
     */
    public function setInvoice(Invoices $invoice): Equipments
    {
        $this->invoice = $invoice;
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
     * @return Equipments
     */
    public function setUser(Users $user): Equipments
    {
        $this->user = $user;
        return $this;
    }
}

