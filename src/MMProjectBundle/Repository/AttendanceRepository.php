<?php


namespace MMProjectBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class AttendanceRepository extends EntityRepository
{
    /**
     * Returns query to all attendances
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->createQueryBuilder('attendance');
    }
}
