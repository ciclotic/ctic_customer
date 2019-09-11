<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface CustomerContactInterface extends IdentifiableInterface, EntityInterface
{
    public function getValue(): string;
    public function getContactPerson(): string;
    public function getCustomer();
    public function setCustomer(Customer $customer): bool;
    public function getCustomerContactCategory();
    public function setCustomerContactCategory(CustomerContactCategory $customerContactCategory): bool;
}