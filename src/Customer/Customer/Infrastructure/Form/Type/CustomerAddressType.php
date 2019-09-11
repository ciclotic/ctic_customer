<?php

namespace CTIC\Customer\Customer\Infrastructure\Form\Type;

use CTIC\Customer\Customer\Domain\CustomerAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerAddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $customers): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('address', TextType::class, [
                'label' => 'Dirección',
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Código postal',
            ])
            ->add('town', TextType::class, [
                'label' => 'Población/Ciudad',
            ])
            ->add('province', TextType::class, [
                'label' => 'Provincia',
            ])
            ->add('country', TextType::class, [
                'label' => 'País',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Teléfono',
            ])
            ->add('contactPerson', TextType::class, [
                'label' => 'Persona de contacto',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CustomerAddress::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_customer_customeraddress';
    }
}
