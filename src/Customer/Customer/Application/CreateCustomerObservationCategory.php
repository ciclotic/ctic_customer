<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerObservationCategoryCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\CustomerObservationCategory;

class CreateCustomerObservationCategory implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerObservationCategoryCommand $command
     * @return EntityInterface|CustomerObservationCategory
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerObservationCategory = new CustomerObservationCategory();
        $customerObservationCategory->setId($command->id);
        $customerObservationCategory->name = (empty($command->name))? '' : $command->name;
        if (!empty($command->company)) {
            $customerObservationCategory->setCompany($command->company);
        }

        return $customerObservationCategory;
    }
}