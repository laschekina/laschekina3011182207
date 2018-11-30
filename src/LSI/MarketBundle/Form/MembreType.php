<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'label' => false
            ))
            ->add('prenom', TextType::class, array(
                'label' => false
            ))
            ->add('fonction', TextType::class, array(
                'label' => false
            ))
            ->add('devis', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('contratAchat', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('vente', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('reference', CheckboxType::class, array(
                'required' => false,
            ))
            ->add('file', FileType::class, array(
                'label' => false,
            ))

        ;
        $builder->remove('mairie');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Membre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_membre';
    }


}
