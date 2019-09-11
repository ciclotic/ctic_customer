<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerAddress;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerAddressRepository extends EntityRepository
{
    /**
     * @return CustomerAddress[]
     */
    public function findAllOrderedByValue(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.address', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerAddress[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.address', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerAddress
     *
     * @throws
     */
    public function findOneRandom(): CustomerAddress
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.address', 'ASC')
            ->getQuery();

        /** @var CustomerAddress $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}