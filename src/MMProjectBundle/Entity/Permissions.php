<?php

namespace MMProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissions
 *
 * @ORM\Table(name="permissions", indexes={@ORM\Index(name="permissions_resources_id_fk", columns={"resource_id"}), @ORM\Index(name="permissions_roles_id_fk", columns={"role_id"})})
 * @ORM\Entity
 */
class Permissions
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
     * @var array
     *
     * @ORM\Column(name="own_perms", type="simple_array", nullable=true)
     */
    private $ownPerms;

    /**
     * @var array
     *
     * @ORM\Column(name="group_perms", type="simple_array", nullable=true)
     */
    private $groupPerms;

    /**
     * @var array
     *
     * @ORM\Column(name="other_perms", type="simple_array", nullable=true)
     */
    private $otherPerms;

    /**
     * @var \MMProjectBundle\Entity\Resources
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Resources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;

    /**
     * @var \MMProjectBundle\Entity\Roles
     *
     * @ORM\ManyToOne(targetEntity="MMProjectBundle\Entity\Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Permissions
     */
    public function setId(int $id): Permissions
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getOwnPerms(): array
    {
        return $this->ownPerms;
    }

    /**
     * @param array $ownPerms
     * @return Permissions
     */
    public function setOwnPerms(array $ownPerms): Permissions
    {
        $this->ownPerms = $ownPerms;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroupPerms(): array
    {
        return $this->groupPerms;
    }

    /**
     * @param array $groupPerms
     * @return Permissions
     */
    public function setGroupPerms(array $groupPerms): Permissions
    {
        $this->groupPerms = $groupPerms;
        return $this;
    }

    /**
     * @return array
     */
    public function getOtherPerms(): array
    {
        return $this->otherPerms;
    }

    /**
     * @param array $otherPerms
     * @return Permissions
     */
    public function setOtherPerms(array $otherPerms): Permissions
    {
        $this->otherPerms = $otherPerms;
        return $this;
    }

    /**
     * @return Resources
     */
    public function getResource(): Resources
    {
        return $this->resource;
    }

    /**
     * @param Resources $resource
     * @return Permissions
     */
    public function setResource(Resources $resource): Permissions
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @return Roles
     */
    public function getRole(): Roles
    {
        return $this->role;
    }

    /**
     * @param Roles $role
     * @return Permissions
     */
    public function setRole(Roles $role): Permissions
    {
        $this->role = $role;
        return $this;
    }
}

