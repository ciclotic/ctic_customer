<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Company\Domain\Company;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use CTIC\App\Base\Domain\IdentifiableTrait;
use CTIC\Customer\Customer\Domain\Validation\CustomerObservationCategoryValidation;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="CTIC\Customer\Customer\Infrastructure\Repository\CustomerObservationCategoryRepository")
 */
class CustomerObservationCategory implements CustomerObservationCategoryInterface
{
    use IdentifiableTrait;
    use CustomerObservationCategoryValidation;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @ORM\ManyToOne(targetEntity="CTIC\App\Company\Domain\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    private $company = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return (empty($this->name))? '' : $this->name;
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
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}