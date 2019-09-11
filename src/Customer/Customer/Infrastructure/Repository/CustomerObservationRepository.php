<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerObservation;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerObservationRepository extends EntityRepository
{
    /**
     * @return CustomerObservation[]
     */
    public function findAllOrderedByAlternativeTitle(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.alternativeTitle', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerObservation[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.alternativeTitle', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerObservation
     *
     * @throws
     */
    public function findOneRandom(): CustomerObservation
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.alternativeTitle', 'ASC')
            ->getQuery();

        /** @var CustomerObservation $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}