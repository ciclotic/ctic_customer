<?php

namespace CTIC\Customer\Customer\Infrastructure\Form\Type;

use CTIC\Customer\Customer\Domain\CustomerContact;
use CTIC\Customer\Customer\Infrastructure\Repository\CustomerContactCategoryRepository;
use Symfony\Component\Form\AbstractType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\Customer\Customer\Domain\CustomerContactCategory;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $customers): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('value', TextType::class, [
                'label' => 'Dato de contacto',
            ])
            ->add('contactPerson', TextType::class, [
                'label' => 'Persona de contacto',
            ])
            ->add('customerContactCategory',  EntityType::class, [
                'label' => 'Categoría de contacto',
                'class' => CustomerContactCategory::class,
                'query_builder' => function (CustomerContactCategoryRepository $er) {
                    return $er
                        ->createQueryBuilder('a');
                },
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CustomerContact::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_customer_customercontact';
    }
}
