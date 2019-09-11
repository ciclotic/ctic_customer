<?php

namespace CTIC\Customer\Customer\Infrastructure\Controller;

use CTIC\App\Base\Infrastructure\Controller\ResourceController;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\Customer\Customer\Domain\CustomerAddress;
use CTIC\Customer\Customer\Domain\CustomerContact;
use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Infrastructure\Request\RequestConfiguration;
use CTIC\Customer\Customer\Domain\CustomerObservation;

class CustomerController extends ResourceController
{
    /**
     * @var CustomerContact[]|null
     */
    protected $oldCustomerContact;
    
    /**
     * @var CustomerObservation[]|null
     */
    protected $oldCustomerObservation;

    /**
     * @var CustomerAddress[]|null
     */
    protected $oldCustomerAddress;

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function completeCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function completeUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        // CUSTOMER CONTACT
        $this->oldCustomerContact = array();
        $customerContacts = $resource->getCustomerContact();

        foreach ($customerContacts as $customerContact) {
            $this->oldCustomerContact[] = $customerContact;
        }
        
        // CUSTOMER OBSERVATION
        $this->oldCustomerObservation = array();
        $customerObservations = $resource->getCustomerObservation();

        foreach ($customerObservations as $customerObservation) {
            $this->oldCustomerObservation[] = $customerObservation;
        }
        
        // CUSTOMER ADDRESS
        $this->oldCustomerAddress = array();
        $customerAddresses = $resource->getCustomerAddress();

        foreach ($customerAddresses as $customerAddress) {
            $this->oldCustomerAddress[] = $customerAddress;
        }
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function postEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $nativeData = $configuration->getRequest()->get('ctic_customer_customer');

        // CUSTOMER CONTACT
        $customerContacts = $resource->getCustomerContact();
        $oldCustomerContacts = $this->oldCustomerContact;

        /** @var CustomerContact $customerContact */
        foreach ($customerContacts as $customerContact) {
            foreach ($oldCustomerContacts as $key => $oldCustomerContact) {
                if ($customerContact->getId() == $oldCustomerContact->getId()) {
                    unset($oldCustomerContacts[$key]);
                }
            }

            $customerContact->customer = $resource;

            $this->manager->persist($customerContact);
        }

        foreach ($oldCustomerContacts as $oldCustomerContact) {
            $this->manager->remove($oldCustomerContact);
        }

        $this->manager->flush();

        // CUSTOMER OBSERVATION
        $customerObservations = $resource->getCustomerObservation();
        $oldCustomerObservations = $this->oldCustomerObservation;

        /** @var CustomerObservation $customerObservation */
        foreach ($customerObservations as $customerObservation) {
            foreach ($oldCustomerObservations as $key => $oldCustomerObservation) {
                if ($customerObservation->getId() == $oldCustomerObservation->getId()) {
                    unset($oldCustomerObservations[$key]);
                }
            }

            $customerObservation->customer = $resource;

            $this->manager->persist($customerObservation);
        }

        foreach ($oldCustomerObservations as $oldCustomerObservation) {
            $this->manager->remove($oldCustomerObservation);
        }

        $this->manager->flush();

        // CUSTOMER ADDRESS
        $customerAddresses = $resource->getCustomerAddress();
        $oldCustomerAddresses = $this->oldCustomerAddress;

        /** @var CustomerAddress $customerAddress */
        foreach ($customerAddresses as $customerAddress) {
            foreach ($oldCustomerAddresses as $key => $oldCustomerAddress) {
                if ($customerAddress->getId() == $oldCustomerAddress->getId()) {
                    unset($oldCustomerAddresses[$key]);
                }
            }

            $customerAddress->customer = $resource;

            $this->manager->persist($customerAddress);
        }

        foreach ($oldCustomerAddresses as $oldCustomerAddress) {
            $this->manager->remove($oldCustomerAddress);
        }

        $this->manager->flush();
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function postCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Customer $resource
     * @param RequestConfiguration $configuration
     */
    protected function postUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }
}