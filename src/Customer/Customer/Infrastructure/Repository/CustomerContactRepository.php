<?php
namespace CTIC\Customer\Customer\Infrastructure\Repository;

use CTIC\Customer\Customer\Domain\CustomerContact;
use CTIC\App\Base\Infrastructure\Repository\EntityRepository;

class CustomerContactRepository extends EntityRepository
{
    /**
     * @return CustomerContact[]
     */
    public function findAllOrderedByValue(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerContact[]
     */
    public function findAllOrderedByName(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    /**
     * @return CustomerContact
     *
     * @throws
     */
    public function findOneRandom(): CustomerContact
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.value', 'ASC')
            ->getQuery();

        /** @var CustomerContact $customer */
        $customer = $qb->setMaxResults(1)->getOneOrNullResult();

        return $customer;
    }
}