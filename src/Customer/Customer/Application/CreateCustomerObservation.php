<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerObservationCategoryCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\Command\CustomerObservationCommand;
use CTIC\Customer\Customer\Domain\CustomerObservation;
use CTIC\Customer\Customer\Domain\CustomerObservationCategory;

class CreateCustomerObservation implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerObservationCommand $command
     * @return EntityInterface|CustomerObservation
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerObservation = new CustomerObservation();
        $customerObservation->setId($command->id);
        $customerObservation->observation = (empty($command->observation))? '' : $command->observation;
        $customerObservation->alternativeTitle = (empty($command->alternativeTitle))? '' : $command->alternativeTitle;
        if (!empty($command->customer)) {
            $customerObservation->setCustomer($command->customer);
        }
        if (!empty($command->customerObservationCategory)) {
            $customerObservation->setCustomerObservationCategory($command->customerObservationCategory);
        }

        return $customerObservation;
    }
}