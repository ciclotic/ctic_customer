<?php
declare(strict_types=1);

namespace CTIC\Customer\Customer\Test\Application;

use CTIC\Customer\Customer\Application\CreateCustomer;
use CTIC\Customer\Customer\Domain\Command\CustomerCommand;
use CTIC\Customer\Customer\Domain\Customer;
use PHPUnit\Framework\TestCase;

final class CreateCustomerTest extends TestCase
{
    public function testCreateAssert()
    {
        $customerCommandRyu = new CustomerCommand();
        $customerCommandRyu->name = 'ryu';
        $customerRyu = CreateCustomer::create($customerCommandRyu);

        $this->assertEquals(Customer::class, get_class($customerRyu));
    }
}