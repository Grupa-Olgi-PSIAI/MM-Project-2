<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoices
 *
 * @ORM\Table(name="invoices", indexes={@ORM\Index(name="invoices_contractor_id_fkey", columns={"contractor_id"}), @ORM\Index(name="invoices_files_id_fk", columns={"file_id"})})
 * @ORM\Entity
 */
class Invoices
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
     * @ORM\Column(name="number", type="string", length=50, nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_date", type="datetime", nullable=false)
     */
    private $invoiceDate;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_net", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountNet;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_gross", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountGross;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_tax", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountTax;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=10, nullable=false)
     */
    private $currency;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_net_currency", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountNetCurrency;

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
     * @return Invoices
     */
    public function setId(int $id): Invoices
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
     * @return Invoices
     */
    public function setVersion(int $version): Invoices
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
     * @return Invoices
     */
    public function setDateCreated(\DateTime $dateCreated): Invoices
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
     * @return Invoices
     */
    public function setLastUpdated(\DateTime $lastUpdated): Invoices
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Invoices
     */
    public function setNumber(string $number): Invoices
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate(): \DateTime
    {
        return $this->invoiceDate;
    }

    /**
     * @param \DateTime $invoiceDate
     * @return Invoices
     */
    public function setInvoiceDate(\DateTime $invoiceDate): Invoices
    {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountNet(): float
    {
        return $this->amountNet;
    }

    /**
     * @param float $amountNet
     * @return Invoices
     */
    public function setAmountNet(float $amountNet): Invoices
    {
        $this->amountNet = $amountNet;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountGross(): float
    {
        return $this->amountGross;
    }

    /**
     * @param float $amountGross
     * @return Invoices
     */
    public function setAmountGross(float $amountGross): Invoices
    {
        $this->amountGross = $amountGross;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTax(): float
    {
        return $this->amountTax;
    }

    /**
     * @param float $amountTax
     * @return Invoices
     */
    public function setAmountTax(float $amountTax): Invoices
    {
        $this->amountTax = $amountTax;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Invoices
     */
    public function setCurrency(string $currency): Invoices
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountNetCurrency(): float
    {
        return $this->amountNetCurrency;
    }

    /**
     * @param float $amountNetCurrency
     * @return Invoices
     */
    public function setAmountNetCurrency(float $amountNetCurrency): Invoices
    {
        $this->amountNetCurrency = $amountNetCurrency;
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
     * @return Invoices
     */
    public function setContractor(Contractors $contractor): Invoices
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
     * @return Invoices
     */
    public function setFile(Files $file): Invoices
    {
        $this->file = $file;
        return $this;
    }
}

