<?php

namespace CTIC\Customer\Customer\Infrastructure\Form\Type;

use CTIC\Customer\Customer\Domain\CustomerObservation;
use CTIC\Customer\Customer\Infrastructure\Repository\CustomerObservationCategoryRepository;
use Symfony\Component\Form\AbstractType;
use CTIC\App\Base\Infrastructure\Doctrine\Form\Type\EntityType;
use CTIC\Customer\Customer\Domain\CustomerObservationCategory;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerObservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $customers): void
    {
        $builder
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('observation', TextareaType::class, [
                'label' => 'Observación',
            ])
            ->add('alternativeTitle', TextType::class, [
                'label' => 'Título alternativo',
            ])
            ->add('customerObservationCategory',  EntityType::class, [
                'label' => 'Categoría de la observación',
                'class' => CustomerObservationCategory::class,
                'query_builder' => function (CustomerObservationCategoryRepository $er) {
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
            'data_class' => CustomerObservation::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_customer_customerobservation';
    }
}
