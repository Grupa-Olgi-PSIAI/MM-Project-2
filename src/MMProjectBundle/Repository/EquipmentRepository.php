<?php


namespace MMProjectBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EquipmentRepository extends EntityRepository
{
    /**
     * Returns query to all equipment
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->createQueryBuilder('equipment');
    }
}
