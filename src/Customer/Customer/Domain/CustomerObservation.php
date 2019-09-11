<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Company\Domain\Company;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Customer\Customer\Domain\Validation\CustomerObservationValidation;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Customer\Customer\Infrastructure\Repository\CustomerObservationRepository")
 */
class CustomerObservation implements CustomerObservationInterface
{
    use IdentifiableTrait;
    use CustomerObservationValidation;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    public $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    public $alternativeTitle;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\Customer", inversedBy="customerObservation")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *
     * @var Customer
     */
    public $customer = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\CustomerObservationCategory")
     * @ORM\JoinColumn(name="customer_Observation_category_id", referencedColumnName="id")
     *
     * @var CustomerObservationCategory
     */
    private $customerObservationCategory = null;

    /**
     * @return string
     */
    public function getObservation(): string
    {
        return (empty($this->observation))? '' : $this->observation;
    }

    /**
     * @return string
     */
    public function getAlternativeTitle(): string
    {
        return (empty($this->alternativeTitle))? '' : $this->alternativeTitle;
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
     * @return CustomerObservationCategory|null
     */
    public function getCustomerObservationCategory()
    {
        return $this->customerObservationCategory;
    }

    /**
     * @param CustomerObservationCategory $customerObservationCategory
     *
     * @return bool
     */
    public function setCustomerObservationCategory(CustomerObservationCategory $customerObservationCategory): bool
    {
        if (get_class($customerObservationCategory) != CustomerObservationCategory::class &&
            array_pop(class_parents($customerObservationCategory)) != CustomerObservationCategory::class) {
            return false;
        }

        $this->customerObservationCategory = $customerObservationCategory;

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