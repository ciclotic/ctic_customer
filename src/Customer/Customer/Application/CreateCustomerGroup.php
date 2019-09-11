<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerGroupCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\CustomerGroup;

class CreateCustomerGroup implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerGroupCommand $command
     * @return EntityInterface|CustomerGroup
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerGroup = new CustomerGroup();
        $customerGroup->setId($command->id);
        $customerGroup->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->company)) {
            $customerGroup->setCompany($command->company);
        }

        return $customerGroup;
    }
}