<?php


namespace MMProjectBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class LicenseRepository extends EntityRepository
{
    /**
     * Returns query to all licenses
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->createQueryBuilder('license');
    }
}
