<?php
namespace CTIC\Customer\Customer\Domain\Fixture;

use CTIC\Customer\Customer\Application\CreateCustomerContactCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Customer\Customer\Domain\Command\CustomerContactCategoryCommand;

class CustomerContactCategoryFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $customerContactCategoryGeneralCommand = new CustomerContactCategoryCommand();
        $customerContactCategoryGeneralCommand->name = 'Teléfono fijo';
        $customerContactCategoryFijo = CreateCustomerContactCategory::create($customerContactCategoryGeneralCommand);
        $manager->persist($customerContactCategoryFijo);

        $customerContactCategoryGeneralCommand = new CustomerContactCategoryCommand();
        $customerContactCategoryGeneralCommand->name = 'Móvil';
        $customerContactCategoryMovil = CreateCustomerContactCategory::create($customerContactCategoryGeneralCommand);
        $manager->persist($customerContactCategoryMovil);

        $customerContactCategoryGeneralCommand = new CustomerContactCategoryCommand();
        $customerContactCategoryGeneralCommand->name = 'Correo electrónico';
        $customerContactCategoryCorreo = CreateCustomerContactCategory::create($customerContactCategoryGeneralCommand);
        $manager->persist($customerContactCategoryCorreo);

        $customerContactCategoryGeneralCommand = new CustomerContactCategoryCommand();
        $customerContactCategoryGeneralCommand->name = 'Sms';
        $customerContactCategorySms = CreateCustomerContactCategory::create($customerContactCategoryGeneralCommand);
        $manager->persist($customerContactCategorySms);

        $manager->flush();
    }
}