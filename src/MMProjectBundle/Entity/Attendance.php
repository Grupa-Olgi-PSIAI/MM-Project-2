<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Attendance
 *
 * @ORM\Table(name="attendances", indexes={@ORM\Index(name="attendances_user_id_fkey", columns={"user_id"})})
 * @ORM\Entity
 */
class Attendance
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
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="time_in", type="datetime", nullable=false)
     */
    private $timeIn;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="time_out", type="datetime", nullable=false)
     */
    private $timeOut;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="text", length=65535, nullable=true)
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
     * @return Attendance
     */
    public function setId(int $id): Attendance
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
     * @return Attendance
     */
    public function setDateCreated(\DateTime $dateCreated): Attendance
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
     * @return Attendance
     */
    public function setLastUpdated(\DateTime $lastUpdated): Attendance
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn(): ?\DateTime
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTime $timeIn
     * @return Attendance
     */
    public function setTimeIn(\DateTime $timeIn): Attendance
    {
        $this->timeIn = $timeIn;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeOut(): ?\DateTime
    {
        return $this->timeOut;
    }

    /**
     * @param \DateTime $timeOut
     * @return Attendance
     */
    public function setTimeOut(\DateTime $timeOut): Attendance
    {
        $this->timeOut = $timeOut;
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
     * @return Attendance
     */
    public function setNotes(?string $notes): Attendance
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
     * @return Attendance
     */
    public function setUser(User $user): Attendance
    {
        $this->user = $user;
        return $this;
    }
}

