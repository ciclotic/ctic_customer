<?php
namespace CTIC\Customer\Customer\Application;

use CTIC\App\Base\Application\CreateInterface;
use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\Customer\Customer\Domain\Command\CustomerCommand;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\App\Company\Domain\Company;
use Doctrine\Common\Collections\ArrayCollection;

class CreateCustomer implements CreateInterface
{
    /**
     * @param CommandInterface|CustomerCommand $command
     * @return EntityInterface|Customer
     */
    public static function create(CommandInterface $command): EntityInterface
    {
        $customer = new Customer();
        $customer->setId($command->id);
        $customer->name = (empty($command->name))? '' : $command->name;
        $customer->businessName = (empty($command->businessName))? '' : $command->businessName;
        $customer->identification = (empty($command->identification))? '' : $command->identification;
        $customer->address = (empty($command->address))? '' : $command->address;
        $customer->postalCode = (empty($command->postalCode))? '' : $command->postalCode;
        $customer->town = (empty($command->town))? '' : $command->town;
        $customer->province = (empty($command->province))? '' : $command->province;
        $customer->country = (empty($command->country))? '' : $command->country;
        $customer->bank = (empty($command->bank))? '' : $command->bank;
        $customer->iban = (empty($command->iban))? '' : $command->iban;
        $customer->paymentDay1 = (empty($command->paymentDay1))? 1 : $command->paymentDay1;
        $customer->paymentDay2 = (empty($command->paymentDay2))? null : $command->paymentDay2;
        $customer->discountSoonPayment = (empty($command->discountSoonPayment))? 0 : $command->discountSoonPayment;
        $customer->discountCustomer = (empty($command->discountCustomer))? false : true;
        $customer->discountProduct = (empty($command->discountProduct))? 0 : $command->discountProduct;
        $customer->discountService = (empty($command->discountService))? 0 : $command->discountService;
        $customer->alertPriceChanges = (empty($command->alertPriceChanges))? false : true;
        $customer->type = (empty($command->type))? null : $command->type;
        $customer->dinners = (empty($command->dinners))? 0 : $command->dinners;
        $customer->gender = (empty($command->gender))? '' : $command->gender;
        $customer->birthDate = (empty($command->birthDate))? new \DateTime() : $command->birthDate;
        $customer->reference = (empty($command->reference))? '' : $command->reference;
        $customer->periodicity = (empty($command->periodicity))? '' : $command->periodicity;
        $customer->enabled = (empty($command->enabled))? false : true;
        if (!empty($command->defaultPaymentMethod)) {
            $customer->setDefaultPaymentMethod($command->defaultPaymentMethod);
        }
        if (!empty($command->defaultRate)) {
            $customer->setDefaultRate($command->defaultRate);
        }
        if (!empty($command->defaultIva)) {
            $customer->setDefaultIva($command->defaultIva);
        }
        if (!empty($command->defaultIrpf)) {
            $customer->setDefaultIrpf($command->defaultIrpf);
        }
        if (!empty($command->recommendedByCustomer)) {
            $customer->setRecommendedByCustomer($command->recommendedByCustomer);
        }
        if (!empty($command->defaultRealizationArea)) {
            $customer->setDefaultRealizationArea($command->defaultRealizationArea);
        }
        if (!empty($command->customerGroup) && get_class($command->customerGroup) == ArrayCollection::class) {
            $customer->setCustomerGroup($command->customerGroup);
        }
        if (!empty($command->customerContact) && get_class($command->customerContact) == ArrayCollection::class) {
            $customer->setCustomerContact($command->customerContact);
        }
        if (!empty($command->customerObservation) && get_class($command->customerObservation) == ArrayCollection::class) {
            $customer->setCustomerObservation($command->customerObservation);
        }
        if (!empty($command->customerAddress) && get_class($command->customerAddress) == ArrayCollection::class) {
            $customer->setCustomerAddress($command->customerAddress);
        }
        if (!empty($command->company)) {
            $customer->setCompany($command->company);
        }

        return $customer;
    }
}