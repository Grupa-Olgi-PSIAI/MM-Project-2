<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles", uniqueConstraints={@ORM\UniqueConstraint(name="roles_authority_uindex", columns={"authority"})})
 * @ORM\Entity
 */
class Roles
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="id", type="boolean")
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
     * @var string
     *
     * @ORM\Column(name="authority", type="string", length=255, nullable=false)
     */
    private $authority;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MMProjectBundle\Entity\Users", inversedBy="role")
     * @ORM\JoinTable(name="user_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return bool
     */
    public function isId(): bool
    {
        return $this->id;
    }

    /**
     * @param bool $id
     * @return Roles
     */
    public function setId(bool $id): Roles
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
     * @return Roles
     */
    public function setVersion(int $version): Roles
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthority(): string
    {
        return $this->authority;
    }

    /**
     * @param string $authority
     * @return Roles
     */
    public function setAuthority(string $authority): Roles
    {
        $this->authority = $authority;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser(): \Doctrine\Common\Collections\Collection
    {
        return $this->user;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $user
     * @return Roles
     */
    public function setUser(\Doctrine\Common\Collections\Collection $user): Roles
    {
        $this->user = $user;
        return $this;
    }
}

