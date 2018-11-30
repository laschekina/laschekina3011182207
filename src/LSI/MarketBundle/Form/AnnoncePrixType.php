<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AnnoncePrixType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mairies', EntityType::class, array(
                'class' => 'LSIMarketBundle:PublicMairie',
                'choice_label' => 'libelle',
                'expanded' => true, 
                'multiple' => true))
            
            ->add('datedebut1', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('datefin1', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('prix1', MoneyType::class)

            ->add('datedebut2', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('datefin2', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('prix2', MoneyType::class)
            
            ->add('administres', EntityType::class, array(
                'class' => 'LSIMarketBundle:PublicAdministre',
                'choice_label' => 'libelle',
                'expanded' => true,
                'multiple' => true))
            ->add('datedebut3', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('datefin3', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('prix3', MoneyType::class)
            ->add('datedebut4', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('datefin4', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('prix4', MoneyType::class)
            ->add('datedebut5', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('datefin5', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'months' => range(date('m'), date('m') + 11),))
            ->add('prix5', MoneyType::class)
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\AnnoncePrix'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_annonceprix';
    }


}
