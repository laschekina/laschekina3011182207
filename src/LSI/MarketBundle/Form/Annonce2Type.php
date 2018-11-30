<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Annonce2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calendrier', CollectionType::class , array(
                'entry_type' => CalendrierType::class,
                'allow_add' => true,
                'allow_delete' => true,
               /*  'data_class' => null, */
            ))
            ->add('save', SubmitType::class, array());


        $builder
            //->remove('calendrier')
            ->remove('dateCreation')
            ->remove('heureCreation')
            ->remove('annonceUpdateAt')
            ->remove('mairie');
        //->remove('dateCreation');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Annonce',
            //'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_annonce';
    }


}
