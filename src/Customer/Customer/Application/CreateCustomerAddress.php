<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerAddressCategoryCommand;
use CTIC\App\Company\Domain\Company;
use CTIC\Customer\Customer\Domain\Command\CustomerAddressCommand;
use CTIC\Customer\Customer\Domain\CustomerAddress;
use CTIC\Customer\Customer\Domain\CustomerAddressCategory;

class CreateCustomerAddress implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerAddressCommand $command
     * @return EntityInterface|CustomerAddress
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customerAddress = new CustomerAddress();
        $customerAddress->setId($command->id);
        $customerAddress->address = (empty($command->address))? '' : $command->address;
        $customerAddress->postalCode = (empty($command->postalCode))? '' : $command->postalCode;
        $customerAddress->town = (empty($command->town))? '' : $command->town;
        $customerAddress->province = (empty($command->province))? '' : $command->province;
        $customerAddress->country = (empty($command->country))? '' : $command->country;
        $customerAddress->phone = (empty($command->phone))? '' : $command->phone;
        $customerAddress->contactPerson = (empty($command->contactPerson))? '' : $command->contactPerson;
        if (!empty($command->customer)) {
            $customerAddress->setCustomer($command->customer);
        }

        return $customerAddress;
    }
}