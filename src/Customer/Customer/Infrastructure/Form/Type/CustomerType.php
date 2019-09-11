<?php

namespace CTIC\Customer\Customer\Infrastructure\Form\Type;

use CTIC\App\Base\Infrastructure\Repository\EntityRepository;
use CTIC\App\Company\Domain\Company;
use CTIC\App\Company\Infrastructure\Repository\CompanyRepository;
use CTIC\App\Base\Infrastructure\Form\Type\AbstractResourceType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\App\Irpf\Domain\Irpf;
use CTIC\App\Irpf\Infrastructure\Repository\IrpfRepository;
use CTIC\App\Iva\Domain\Iva;
use CTIC\App\Iva\Infrastructure\Repository\IvaRepository;
use CTIC\App\PaymentMethod\Domain\PaymentMethod;
use CTIC\App\PaymentMethod\Infrastructure\Repository\PaymentMethodRepository;
use CTIC\App\Permission\Domain\PermissionInterface;
use CTIC\App\Rate\Domain\Rate;
use CTIC\App\Rate\Infrastructure\Repository\RateRepository;
use CTIC\App\RealizationArea\Domain\RealizationArea;
use CTIC\App\RealizationArea\Infrastructure\Repository\RealizationAreaRepository;
use CTIC\App\User\Domain\User;
use CTIC\App\User\Infrastructure\Repository\UserRepository;
use CTIC\Customer\Customer\Domain\Customer;
use CTIC\Customer\Customer\Domain\CustomerGroup;
use CTIC\Customer\Customer\Domain\CustomerInterface;
use CTIC\Customer\Customer\Infrastructure\Repository\CustomerRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $customers): void
    {
        $builder
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Nombre fiscal',
            ])
            ->add('businessName', TextType::class, [
                'label' => 'Nombre comercial',
            ])
            ->add('identification', TextType::class, [
                'label' => 'CIF / NIF',
            ])
            ->add('address', TextType::class, [
                'label' => 'Dirección',
                'required' => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Código Postal',
                'required' => false,
            ])
            ->add('town', TextType::class, [
                'label' => 'Población/Ciudad',
                'required' => false,
            ])
            ->add('province', TextType::class, [
                'label' => 'Provincia/Estado',
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'label' => 'País',
                'required' => false,
            ])
            ->add('bank', TextType::class, [
                'label' => 'Banco',
                'required' => false,
            ])
            ->add('iban', TextType::class, [
                'label' => 'Iban',
                'required' => false,
            ])
            ->add('paymentDay1', NumberType::class, [
                'label' => 'Día de pago 1',
                'required' => false,
            ])
            ->add('paymentDay2', NumberType::class, [
                'label' => 'Día de pago 2',
                'required' => false,
            ])
            ->add('discountSoonPayment', NumberType::class, [
                'label' => 'Descuento pronto pago',
                'required' => false,
            ])
            ->add('discountCustomer', ChoiceType::class, [
                'label' => 'Tiene descuento cliente',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                ),
                'required' => false,
            ])
            ->add('discountProduct', NumberType::class, [
                'label' => 'Descuento por producto',
                'required' => false,
            ])
            ->add('discountService', NumberType::class, [
                'label' => 'Descuento por servicio',
                'required' => false,
            ])
            ->add('alertPriceChanges', ChoiceType::class, [
                'label' => 'Alertar cambio de precios',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                ),
                'required' => false,
            ])
            ->add('type', TextType::class, [
                'label' => 'Tipo',
                'required' => false,
            ])
            ->add('dinners', NumberType::class, [
                'label' => 'Número de comensales',
                'required' => false,
            ])
            ->add('gender', TextType::class, [
                'label' => 'Género',
                'required' => false,
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Fecha de nacimiento',
                'required' => false,
            ])
            ->add('reference', TextType::class, [
                'label' => 'Referencia',
                'required' => false,
            ])
            ->add('periodicity', TextType::class, [
                'label' => 'Periodicidad',
                'required' => false,
            ])
            ->add('enabled', ChoiceType::class, [
                'label'     => 'Habilitado',
                'choices'   => array(
                    'Si'    => 1,
                    'No'    => 0
                )
            ])
            ->add('defaultPaymentMethod',  EntityType::class, [
                'label' => 'Método de pago por defecto',
                'class' => PaymentMethod::class,
                'query_builder' => function (PaymentMethodRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultRate',  EntityType::class, [
                'label' => 'Tarifa por defecto',
                'class' => Rate::class,
                'query_builder' => function (RateRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultIva',  EntityType::class, [
                'label' => 'IVA por defecto',
                'class' => Iva::class,
                'query_builder' => function (IvaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultIrpf',  EntityType::class, [
                'label' => 'IRPF por defecto',
                'class' => Irpf::class,
                'query_builder' => function (IrpfRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('recommendedByCustomer',  EntityType::class, [
                'label' => 'Recomendado por el cliente',
                'class' => Customer::class,
                'query_builder' => function (CustomerRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('defaultRealizationArea',  EntityType::class, [
                'label' => 'Área de realización por defecto',
                'class' => RealizationArea::class,
                'query_builder' => function (RealizationAreaRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('customerGroup', EntityType::class, [
                'label'         => 'Grupo (Multiselección)',
                'class'         => CustomerGroup::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ec')
                        ->orderBy('ec.name', 'ASC');
                },
                'expanded'      => false,
                'multiple'      => true,
                'choice_label' => 'name'
            ])
            ->add('customerContact', CollectionType::class, [
                'label'                 => 'Formas de contacto',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-customerContact__',
                'entry_type'            => CustomerContactType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('customerObservation', CollectionType::class, [
                'label'                 => 'Observaciones',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-customerObservation__',
                'entry_type'            => CustomerObservationType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('customerAddress', CollectionType::class, [
                'label'                 => 'Direcciones de entrega',
                'label_attr'            => array(
                    'element'     => 'h5',
                    'label_class' => 'panel-heading',
                    'group_class' => 'panel panel-primary'
                ),
                'prototype_name'        => '__name-customerAddress__',
                'entry_type'            => CustomerAddressType::class,
                'prototype'             => true,
                'allow_add'             => true,
                'allow_delete'          => true
            ])
            ->add('company',  EntityType::class, [
                'label' => 'Empresa',
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'taxName'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_customer_customer';
    }
}
