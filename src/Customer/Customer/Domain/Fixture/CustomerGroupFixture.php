<?php
namespace CTIC\Customer\Customer\Domain\Fixture;

use CTIC\Customer\Customer\Application\CreateCustomerGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Customer\Customer\Domain\Command\CustomerGroupCommand;

class CustomerGroupFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $customerGroupGeneralCommand = new CustomerGroupCommand();
        $customerGroupGeneralCommand->name = 'General';
        $customerGroup = CreateCustomerGroup::create($customerGroupGeneralCommand);
        $manager->persist($customerGroup);

        $manager->flush();
    }
}