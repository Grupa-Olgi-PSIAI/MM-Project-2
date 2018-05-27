<?php


namespace MMProjectBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class DocumentRepository extends EntityRepository
{
    /**
     * Returns query to all documents
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->createQueryBuilder('document');
    }
}
