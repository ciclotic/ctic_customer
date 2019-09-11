<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Company\Domain\Company;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\App\User\Domain\User;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface CustomerInterface extends IdentifiableInterface, EntityInterface
{
    public function getName();
    public function getBusinessName();
    public function getIdentification();
    public function getAddress();
    public function getPostalCode();
    public function getTown();
    public function getProvince();
    public function getCountry();
    public function getBank();
    public function getIban();
    public function getPaymentDay1();
    public function getPaymentDay2();
    public function getDiscountSoonPayment();
    public function isDiscountCustomer();
    public function getDiscountProduct();
    public function getDiscountService();
    public function isAlertPriceChanges();
    public function getType();
    public function getDinners();
    public function getGender();
    public function getBirthDate();
    public function getReference();
    public function getPeriodicity();
    public function getDefaultPaymentMethod();
    public function setDefaultPaymentMethod(PaymentMethod $defaultPaymentMethod): bool;
    public function getDefaultRate();
    public function setDefaultRate(Rate $defaultRate): bool;
    public function getDefaultIva();
    public function setDefaultIva(Iva $iva): bool;
    public function getDefaultIrpf();
    public function setDefaultIrpf(Irpf $irpf): bool;
    public function getRecommendedByCustomer();
    public function setRecommendedByCustomer(Customer $recommendedByCustomer): bool;
    public function getDefaultRealizationArea();
    public function setDefaultRealizationArea(RealizationArea $defaultRealizationArea): bool;
    public function getCompany();
    public function setCompany(Company $company): bool;
    public function getCustomerContact();
    public function setCustomerContact($customerContact): bool;
    public function getCustomerObservation();
    public function setCustomerObservation($customerObservation): bool;
    public function getCustomerAddress();
    public function setCustomerAddress($customerAddress): bool;
    public function isEnabled();
}