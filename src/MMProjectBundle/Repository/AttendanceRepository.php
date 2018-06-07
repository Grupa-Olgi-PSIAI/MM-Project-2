<?php


namespace MMProjectBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use MMProjectBundle\Entity\User;

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

    /**
     * Returns query to attendances for given user
     *
     * @param User $user
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryByUser(User $user): QueryBuilder
    {
        return $this->createQueryBuilder('attendance')
            ->where('attendance.user = :user')
            ->setParameter('user', $user);
    }
}
