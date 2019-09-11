<?php
namespace CTIC\Customer\Customer\Domain\Fixture;

use CTIC\Customer\Customer\Application\CreateCustomerObservationCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Customer\Customer\Domain\Command\CustomerObservationCategoryCommand;

class CustomerObservationCategoryFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $customerObservationCategoryGeneralCommand = new CustomerObservationCategoryCommand();
        $customerObservationCategoryGeneralCommand->name = 'General';
        $customerObservationCategoryGeneral = CreateCustomerObservationCategory::create($customerObservationCategoryGeneralCommand);
        $manager->persist($customerObservationCategoryGeneral);

        $manager->flush();
    }
}