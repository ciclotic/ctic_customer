<?php
namespace CTIC\Customer\Customer\Domain\Command;

use CTIC\App\Base\Domain\Command\CommandInterface;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\Customer\Customer\Domain\CustomerObservationCategory;

class CustomerObservationCommand implements CommandInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $observation;

    /**
     * @var string
     */
    public $alternativeTitle;

    /**
     * @var Customer
     */
    public $customer = null;

    /**
     * @var CustomerObservationCategory
     */
    public $customerObservationCategory = null;
}