<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use LSI\MarketBundle\Repository\VilleRepository;

class AdresseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville', EntityType::class, array(
                'class' => 'LSIMarketBundle:Ville',
                'query_builder' => function (VilleRepository $er) {
                    return $er->findAllCities();
                    //createQueryBuilder('v')
                      //  ->orderBy('v.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => false,
                'placeholder' => 'Sélectionner votre ville',
                ))
            ->add('pays', TextType::class, array(
                'constraints' => array(
                    new NotBlank())))
            ->add('rue', TextType::class, array(
                'constraints' => array(
                    new NotBlank())))
            ->add('codePostal', TextType::class, array(
                'constraints' => array(
                    new NotBlank())))
            
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Adresse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_adresse';
    }

}
