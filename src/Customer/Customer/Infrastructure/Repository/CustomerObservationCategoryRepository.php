<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerObservationCategory;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerObservationCategoryRepository extends EntityRepository
{
    /**
     * @return CustomerObservationCategory[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerObservationCategory
     *
     * @throws
     */
    public function findOneRandom(): CustomerObservationCategory
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var CustomerObservationCategory $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}