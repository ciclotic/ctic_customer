<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Company\Domain\Company;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Customer\Customer\Domain\Validation\CustomerAddressValidation;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Customer\Customer\Infrastructure\Repository\CustomerAddressRepository")
 */
class CustomerAddress implements CustomerAddressInterface
{
    use IdentifiableTrait;
    use CustomerAddressValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $address;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @var string
     */
    public $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $town;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $province;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $country;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    public $contactPerson;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\Customer", inversedBy="customerAddress")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @var Customer
     */
    public $customer = null;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return (empty($this->address))? '' : $this->address;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return (empty($this->postalCode))? '' : $this->postalCode;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return (empty($this->town))? '' : $this->town;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return (empty($this->province))? '' : $this->province;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return (empty($this->country))? '' : $this->country;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return (empty($this->phone))? '' : $this->phone;
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
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}