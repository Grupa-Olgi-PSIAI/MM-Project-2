<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipment
 *
 * @ORM\Table(name="equipments", indexes={@ORM\Index(name="equipments_invoice_id_fkey", columns={"invoice_id"}), @ORM\Index(name="equipments_user_id_fkey", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="MMProjectBundle\Repository\EquipmentRepository")
 */
class Equipment
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
     * @ORM\Column(name="serial_number", type="string", length=50, nullable=false)
     */
    private $serialNumber;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="validation_date", type="date", nullable=false)
     */
    private $validationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="purchase_date", type="date", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="price_net", type="float", precision=10, scale=0, nullable=false)
     */
    private $priceNet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="text", length=65535, nullable=true)
     */
    private $notes;

    /**
     * @var \MMProjectBundle\Entity\Invoice
     *
     * @ORM\ManyToOne(targetEntity="Invoice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     * })
     */
    private $invoice;

    /**
     * @var \MMProjectBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User")
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
     * @return Equipment
     */
    public function setId(int $id): Equipment
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
     * @return Equipment
     */
    public function setDateCreated(\DateTime $dateCreated): Equipment
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
     * @return Equipment
     */
    public function setLastUpdated(\DateTime $lastUpdated): Equipment
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
     * @return Equipment
     */
    public function setInventoryNumber(string $inventoryNumber): Equipment
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
     * @return Equipment
     */
    public function setName(string $name): Equipment
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     * @return Equipment
     */
    public function setSerialNumber(string $serialNumber): Equipment
    {
        $this->serialNumber = $serialNumber;
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
     * @return Equipment
     */
    public function setValidationDate(\DateTime $validationDate): Equipment
    {
        $this->validationDate = $validationDate;
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
     * @return Equipment
     */
    public function setPurchaseDate(?\DateTime $purchaseDate): Equipment
    {
        $this->purchaseDate = $purchaseDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceNet(): ?float
    {
        return $this->priceNet;
    }

    /**
     * @param float $priceNet
     * @return Equipment
     */
    public function setPriceNet(float $priceNet): Equipment
    {
        $this->priceNet = $priceNet;
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
     * @return Equipment
     */
    public function setNotes(?string $notes): Equipment
    {
        $this->notes = $notes;
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
     * @return Equipment
     */
    public function setInvoice(Invoice $invoice): Equipment
    {
        $this->invoice = $invoice;
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
     * @return Equipment
     */
    public function setUser(User $user): Equipment
    {
        $this->user = $user;
        return $this;
    }
}

