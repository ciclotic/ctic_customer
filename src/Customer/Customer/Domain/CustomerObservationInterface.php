<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface CustomerObservationInterface extends IdentifiableInterface, EntityInterface
{
    public function getObservation(): string;
    public function getAlternativeTitle(): string;
    public function getCustomer();
    public function setCustomer(Customer $customer): bool;
    public function getCustomerObservationCategory();
    public function setCustomerObservationCategory(CustomerObservationCategory $customerObservationCategory): bool;
}