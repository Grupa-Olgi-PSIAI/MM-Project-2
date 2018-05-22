<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attendances
 *
 * @ORM\Table(name="attendances", indexes={@ORM\Index(name="attendances_user_id_fkey", columns={"user_id"})})
 * @ORM\Entity
 */
class Attendances
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
     * @var \DateTime
     *
     * @ORM\Column(name="time_in", type="datetime", nullable=false)
     */
    private $timeIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_out", type="datetime", nullable=false)
     */
    private $timeOut;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=65535, nullable=true)
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Attendances
     */
    public function setId(int $id): Attendances
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
     * @return Attendances
     */
    public function setVersion(int $version): Attendances
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
     * @return Attendances
     */
    public function setDateCreated(\DateTime $dateCreated): Attendances
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
     * @return Attendances
     */
    public function setLastUpdated(\DateTime $lastUpdated): Attendances
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn(): \DateTime
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTime $timeIn
     * @return Attendances
     */
    public function setTimeIn(\DateTime $timeIn): Attendances
    {
        $this->timeIn = $timeIn;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeOut(): \DateTime
    {
        return $this->timeOut;
    }

    /**
     * @param \DateTime $timeOut
     * @return Attendances
     */
    public function setTimeOut(\DateTime $timeOut): Attendances
    {
        $this->timeOut = $timeOut;
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
     * @return Attendances
     */
    public function setNotes(string $notes): Attendances
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
     * @return Attendances
     */
    public function setUser(Users $user): Attendances
    {
        $this->user = $user;
        return $this;
    }
}

