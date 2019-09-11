<?php
namespace CTIC\Customer\Customer\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\Customer\Customer\Domain\CustomerContactCategory;

class CustomerContactCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $contactPerson;

    /**
     * @var Customer
     */
    public $customer = null;

    /**
     * @var CustomerContactCategory
     */
    public $customerContactCategory = null;
}