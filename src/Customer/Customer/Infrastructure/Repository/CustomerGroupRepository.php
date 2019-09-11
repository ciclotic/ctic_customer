<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerGroup;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerGroupRepository extends EntityRepository
{
    /**
     * @return CustomerGroup[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerGroup
     *
     * @throws
     */
    public function findOneRandom(): CustomerGroup
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var CustomerGroup $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}