<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserverType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ReserveAt', DateTimeType::class)
            ->add('debutPrestation', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
                //'years' => range(date('Y'), date('Y') + 2),
                //'months' => range(date('m'), date('m') + 11),
                //'days' => range(date('d'), date('d')+ 31- date('d')),
                //'attr' => array('class' => 'js-datepicker'),
            ))
            ->add('finPrestation', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
                //'years' => range(date('Y'), date('Y') + 2),
                //'months' => range(date('m'), date('m') + 11),
                'attr' => array('disabled' => true),
            ))
            ->add('prixLocation', TextType::class,array(
                'label' => false
            ))
            ->add('montantReservation', TextType::class,array(
                'label' => false
            ))
            ->add('budgetRestant', TextType::class,array(
                'label' => false
            ))
            ->add('assurance', CheckboxType::class,array(
                'label' => false
            ))

            ->add('reserveUpdateAt', DateTimeType::class, array(
                'input' => 'datetime',
                'widget' => 'choice',
            ))
            ->add('reserveEtat', TextType::class, array('required' => true))
            ->add('annonce')
            ->add('user')
            ->add('save', SubmitType::class, array(
                'label' => 'Reserver l\'annonce',
                'attr' => array('disabled' => true),
                ))
        ;

        $builder
            ->remove('ReserveAt')
            ->remove('reserveUpdateAt')
            ->remove('reserveEtat')
            ->remove('annonce')
            ->remove('user')
            /*->remove('prixLocation')
            ->remove('montantReservation')
            ->remove('budgetRestant')
            ->remove('assurance')*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Reserver'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_reserver';
    }


}
