<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerContactCategoryCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\Command\CustomerContactCommand;
use CTIC\Customer\Customer\Domain\CustomerContact;
use CTIC\Customer\Customer\Domain\CustomerContactCategory;

class CreateCustomerContact implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerContactCommand $command
     * @return EntityInterface|CustomerContact
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerContact = new CustomerContact();
        $customerContact->setId($command->id);
        $customerContact->value = (empty($command->value))? '' : $command->value;
        $customerContact->contactPerson = (empty($command->contactPerson))? '' : $command->contactPerson;
        if (!empty($command->customer)) {
            $customerContact->setCustomer($command->customer);
        }
        if (!empty($command->customerContactCategory)) {
            $customerContact->setCustomerContactCategory($command->customerContactCategory);
        }

        return $customerContact;
    }
}