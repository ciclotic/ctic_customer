<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;
use CTIC\App\Company\Domain\Company;

interface CustomerContactCategoryInterface extends IdentifiableInterface, EntityInterface
{
    public function getName(): string;
    public function getCompany();
    public function setCompany(Company $company): bool;
}