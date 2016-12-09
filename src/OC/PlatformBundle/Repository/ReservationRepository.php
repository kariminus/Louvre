<?php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * ReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByDate($date)
    {
        $qb = $this->createQueryBuilder('r');

        $qb->where('r.date = :date')
            ->setParameter('date', $date)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
