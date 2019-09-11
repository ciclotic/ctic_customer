<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerContactCategory;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerContactCategoryRepository extends EntityRepository
{
    /**
     * @return CustomerContactCategory[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerContactCategory
     *
     * @throws
     */
    public function findOneRandom(): CustomerContactCategory
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC')
            ->getQuery();

        /** @var CustomerContactCategory $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}