<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerContactCategoryCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\CustomerContactCategory;

class CreateCustomerContactCategory implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerContactCategoryCommand $command
     * @return EntityInterface|CustomerContactCategory
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerContactCategory = new CustomerContactCategory();
        $customerContactCategory->setId($command->id);
        $customerContactCategory->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->company)) {
            $customerContactCategory->setCompany($command->company);
        }

        return $customerContactCategory;
    }
}