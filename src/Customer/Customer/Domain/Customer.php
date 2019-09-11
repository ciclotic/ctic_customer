<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Customer\Customer\Domain\Validation\CustomerValidation;
use CTIC\App\Company\Domain\Company;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Customer\Customer\Infrastructure\Repository\CustomerRepository")
 */
class Customer implements CustomerInterface
{
    use IdentifiableTrait;
    use CustomerValidation;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @var string
     */
    public $businessName;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @var string
     */
    public $identification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    public $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *
     * @var string
     */
    public $postalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $town;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $province;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $country;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $bank;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $iban;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $paymentDay1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $paymentDay2;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountSoonPayment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    public $discountCustomer;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountProduct;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    public $discountService;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var bool
     */
    public $alertPriceChanges;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $dinners;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    public $birthDate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     * @var string
     */
    public $reference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    public $periodicity;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    public $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\PaymentMethod\Domain\PaymentMethod")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id", nullable=true)
     *
     * @var PaymentMethod
     */
    private $defaultPaymentMethod = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Rate\Domain\Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id", nullable=true)
     *
     * @var Rate
     */
    private $defaultRate = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Iva\Domain\Iva")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var Iva
     */
    private $defaultIva = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Irpf\Domain\Irpf")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var Irpf
     */
    private $defaultIrpf = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\Customer\Customer\Domain\Customer")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var Customer
     */
    private $recommendedByCustomer = null;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\RealizationArea\Domain\RealizationArea")
     * @ORM\JoinColumn(name="iva_id", referencedColumnName="id", nullable=true)
     *
     * @var RealizationArea
     */
    private $defaultRealizationArea = null;

    /**
     * @ORM\ManyToMany(targetEntity="CTIC\Customer\Customer\Domain\CustomerGroup")
     *
     * @var CustomerGroup[]
     */
    private $customerGroup;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Customer\Customer\Domain\CustomerContact", mappedBy="customer", cascade={"persist", "remove"})
     *
     * @var CustomerContact[]
     */
    private $customerContact;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Customer\Customer\Domain\CustomerObservation", mappedBy="customer", cascade={"persist", "remove"})
     *
     * @var CustomerObservation[]
     */
    private $customerObservation;

    /**
     * @ORM\OneToMany(targetEntity="CTIC\Customer\Customer\Domain\CustomerAddress", mappedBy="customer", cascade={"persist", "remove"})
     *
     * @var CustomerAddress[]
     */
    private $customerAddress;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    private $company = null;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->customerGroup = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return int
     */
    public function getPaymentDay1()
    {
        return $this->paymentDay1;
    }

    /**
     * @return int
     */
    public function getPaymentDay2()
    {
        return $this->paymentDay2;
    }

    /**
     * @return float
     */
    public function getDiscountSoonPayment()
    {
        return $this->discountSoonPayment;
    }

    /**
     * @return bool
     */
    public function isDiscountCustomer()
    {
        return $this->discountCustomer;
    }

    /**
     * @return float
     */
    public function getDiscountProduct()
    {
        return $this->discountProduct;
    }

    /**
     * @return float
     */
    public function getDiscountService()
    {
        return $this->discountService;
    }

    /**
     * @return bool
     */
    public function isAlertPriceChanges()
    {
        return $this->alertPriceChanges;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getDinners()
    {
        return $this->dinners;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return int
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * @return PaymentMethod|null
     */
    public function getDefaultPaymentMethod()
    {
        return $this->defaultPaymentMethod;
    }

    /**
     * @param PaymentMethod $defaultPaymentMethod
     *
     * @return bool
     */
    public function setDefaultPaymentMethod(PaymentMethod $defaultPaymentMethod): bool
    {
        if (get_class($defaultPaymentMethod) != PaymentMethod::class &&
            array_pop(class_parents($defaultPaymentMethod)) != PaymentMethod::class) {
            return false;
        }

        $this->defaultPaymentMethod = $defaultPaymentMethod;

        return true;
    }

    /**
     * @return Rate|null
     */
    public function getDefaultRate()
    {
        return $this->defaultRate;
    }

    /**
     * @param Rate $defaultRate
     *
     * @return bool
     */
    public function setDefaultRate(Rate $defaultRate): bool
    {
        if (get_class($defaultRate) != Rate::class &&
            array_pop(class_parents($defaultRate)) != Rate::class) {
            return false;
        }

        $this->defaultRate = $defaultRate;

        return true;
    }

    /**
     * @return Iva|null
     */
    public function getDefaultIva()
    {
        return $this->defaultIva;
    }

    /**
     * @param Iva $iva
     *
     * @return bool
     */
    public function setDefaultIva(Iva $iva): bool
    {
        if (get_class($iva) != Iva::class &&
            array_pop(class_parents($iva)) != Iva::class) {
            return false;
        }

        $this->defaultIva = $iva;

        return true;
    }

    /**
     * @return Irpf|null
     */
    public function getDefaultIrpf()
    {
        return $this->defaultIrpf;
    }

    /**
     * @param Irpf $irpf
     *
     * @return bool
     */
    public function setDefaultIrpf(Irpf $irpf): bool
    {
        if (get_class($irpf) != Irpf::class &&
            array_pop(class_parents($irpf)) != Irpf::class) {
            return false;
        }

        $this->defaultIrpf = $irpf;

        return true;
    }

    /**
     * @return Customer|null
     */
    public function getRecommendedByCustomer()
    {
        return $this->recommendedByCustomer;
    }

    /**
     * @param Customer $recommendedByCustomer
     *
     * @return bool
     */
    public function setRecommendedByCustomer(Customer $recommendedByCustomer): bool
    {
        if (get_class($recommendedByCustomer) != Customer::class &&
            array_pop(class_parents($recommendedByCustomer)) != Customer::class) {
            return false;
        }

        $this->recommendedByCustomer = $recommendedByCustomer;

        return true;
    }

    /**
     * @return RealizationArea|null
     */
    public function getDefaultRealizationArea()
    {
        return $this->defaultRealizationArea;
    }

    /**
     * @param RealizationArea $defaultRealizationArea
     *
     * @return bool
     */
    public function setDefaultRealizationArea(RealizationArea $defaultRealizationArea): bool
    {
        if (get_class($defaultRealizationArea) != RealizationArea::class &&
            array_pop(class_parents($defaultRealizationArea)) != RealizationArea::class) {
            return false;
        }

        $this->defaultRealizationArea = $defaultRealizationArea;

        return true;
    }

    /**
     * @return CustomerGroup[]|ArrayCollection
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

    /**
     * @param $customerGroup
     * @return bool
     */
    public function setCustomerGroup($customerGroup): bool
    {
        if (get_class($customerGroup) != ArrayCollection::class) {
            return false;
        }

        $this->customerGroup = $customerGroup;

        return true;
    }

    /**
     * @return CustomerContact[]|ArrayCollection
     */
    public function getCustomerContact()
    {
        return $this->customerContact;
    }

    /**
     * @param $customerContact
     * @return bool
     */
    public function setCustomerContact($customerContact): bool
    {
        if (get_class($customerContact) != ArrayCollection::class) {
            return false;
        }

        $this->customerContact = $customerContact;

        return true;
    }

    /**
     * @return CustomerObservation[]|ArrayCollection
     */
    public function getCustomerObservation()
    {
        return $this->customerObservation;
    }

    /**
     * @param $customerObservation
     * @return bool
     */
    public function setCustomerObservation($customerObservation): bool
    {
        if (get_class($customerObservation) != ArrayCollection::class) {
            return false;
        }

        $this->customerObservation = $customerObservation;

        return true;
    }

    /**
     * @return CustomerAddress[]|ArrayCollection
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @param $customerAddress
     * @return bool
     */
    public function setCustomerAddress($customerAddress): bool
    {
        if (get_class($customerAddress) != ArrayCollection::class) {
            return false;
        }

        $this->customerAddress = $customerAddress;

        return true;
    }

    /**
     * @return Company|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     *
     * @return bool
     */
    public function setCompany(Company $company): bool
    {
        if (get_class($company) != Company::class &&
            array_pop(class_parents($company)) != Company::class) {
            return false;
        }

        $this->company = $company;

        return true;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}