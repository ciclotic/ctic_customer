<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Company\Domain\Company;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Customer\Customer\Domain\Validation\CustomerContactValidation;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Customer\Customer\Infrastructure\Repository\CustomerContactRepository")
 */
class CustomerContact implements CustomerContactInterface
{
    use IdentifiableTrait;
    use CustomerContactValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $value;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $contactPerson;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\Customer", inversedBy="customerContact")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @var Customer
     */
    public $customer = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\CustomerContactCategory")
     * @ORM\JoinColumn(name="customer_contact_category_id", referencedColumnName="id")
     *
     * @var CustomerContactCategory
     */
    private $customerContactCategory = null;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return (empty($this->value))? '' : $this->value;
    }

    /**
     * @return string
     */
    public function getContactPerson(): string
    {
        return (empty($this->contactPerson))? '' : $this->contactPerson;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return bool
     */
    public function setCustomer(Customer $customer): bool
    {
        if (get_class($customer) != Customer::class &&
            array_pop(class_parents($customer)) != Customer::class) {
            return false;
        }

        $this->customer = $customer;

        return true;
    }

    /**
     * @return CustomerContactCategory|null
     */
    public function getCustomerContactCategory()
    {
        return $this->customerContactCategory;
    }

    /**
     * @param CustomerContactCategory $customerContactCategory
     *
     * @return bool
     */
    public function setCustomerContactCategory(CustomerContactCategory $customerContactCategory): bool
    {
        if (get_class($customerContactCategory) != CustomerContactCategory::class &&
            array_pop(class_parents($customerContactCategory)) != CustomerContactCategory::class) {
            return false;
        }

        $this->customerContactCategory = $customerContactCategory;

        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}