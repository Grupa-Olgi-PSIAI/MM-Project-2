<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Invoice
 *
 * @ORM\Table(name="invoices", indexes={@ORM\Index(name="invoices_contractor_id_fkey", columns={"contractor_id"})})
 * @ORM\Entity(repositoryClass="MMProjectBundle\Repository\InvoiceRepository")
 *
 * @Vich\Uploadable
 */
class Invoice
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
     * @ORM\Column(name="number", type="string", length=50, nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="invoice_date", type="datetime", nullable=false)
     */
    private $invoiceDate;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="amount_net", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountNet;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="amount_gross", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountGross;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="currency", type="string", length=10, nullable=false)
     */
    private $currency;

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
     * @return Invoice
     */
    public function setId(int $id): Invoice
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
     * @return Invoice
     */
    public function setDateCreated(\DateTime $dateCreated): Invoice
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
     * @return Invoice
     */
    public function setLastUpdated(\DateTime $lastUpdated): Invoice
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Invoice
     */
    public function setNumber(string $number): Invoice
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate(): ?\DateTime
    {
        return $this->invoiceDate;
    }

    /**
     * @param \DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate(\DateTime $invoiceDate): Invoice
    {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountNet(): ?float
    {
        return $this->amountNet;
    }

    /**
     * @param float $amountNet
     * @return Invoice
     */
    public function setAmountNet(float $amountNet): Invoice
    {
        $this->amountNet = $amountNet;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountGross(): ?float
    {
        return $this->amountGross;
    }

    /**
     * @param float $amountGross
     * @return Invoice
     */
    public function setAmountGross(float $amountGross): Invoice
    {
        $this->amountGross = $amountGross;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Invoice
     */
    public function setCurrency(string $currency): Invoice
    {
        $this->currency = $currency;
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
     * @return Invoice
     */
    public function setContractor(Contractor $contractor): Invoice
    {
        $this->contractor = $contractor;
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
     * @return Invoice
     */
    public function setFile(File $file = null): Invoice
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
     * @return Invoice
     */
    public function setEmbeddedFile(EmbeddedFile $embeddedFile): Invoice
    {
        $this->embeddedFile = $embeddedFile;
        return $this;
    }
}

