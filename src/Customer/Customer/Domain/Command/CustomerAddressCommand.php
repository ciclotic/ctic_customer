<?php
namespace CTIC\Customer\Customer\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\Customer\Customer\Domain\CustomerAddressCategory;

class CustomerAddressCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $postalCode;

    /**
     * @var string
     */
    public $town;

    /**
     * @var string
     */
    public $province;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $contactPerson;

    /**
     * @var Customer
     */
    public $customer = null;
}