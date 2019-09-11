<?php
namespace CTIC\Customer\Customer\Domain\Fixture;

use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use CTIC\Customer\Customer\Application\CreateCustomer;
use CTIC\Customer\Customer\Domain\Command\CustomerCommand;

class CustomerContactFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {

    }
}