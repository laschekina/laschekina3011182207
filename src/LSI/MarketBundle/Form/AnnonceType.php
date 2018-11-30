<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'label' => 'Titre de l\'annonce',
                'required' => true,
            ))
            ->add('nature', EntityType::class, array(
                'label' => 'Nature de l\'annonce',
                'class' => 'LSIMarketBundle:Nature',
                'choice_label' => 'name_nature',
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Sélectionner une nature',
            ))
            ->add('fonction', EntityType::class, array(
                'label' => 'Fonction de l\'annonce',
                'class' => 'LSIMarketBundle:Fonction',
                'choice_label' => 'name_fonction',
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Sélectionner une fonction',
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description de l\'annonce',
                'required' => true,
            ))
            ->add('regleCond', TextType::class, array(
                'label' => 'Règle',
                'required' => true,
            ))
            ->add('typeforfait',ChoiceType::class, array(
                'label' => 'type de forfait',
                'placeholder' => 'choisir un type de forfait',
                'choices' => array(
                    '€/jour' => '€/jour',
                    '€/heure' => '€/heure',)))
            ->add('prixDefaut', MoneyType::class, array(
                'label' => 'Prix par defaut',
                'required' => true,
            ))
            ->add('dateCreation', DateType::class, array(
                'label' => 'Date de création de l\'annonce',
                'required' => true,
            ))
            ->add('heureCreation',DateTimeType::class
            )
            ->add('annonceUpdateAt', DateTimeType::class)
            ->add('mairie')
            ->add('images', CollectionType::class, array(
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'required' => true,
                'by_reference' => true,
                'delete_empty' => true,
                ))
            ->add('adresse',AdresseType::class)
            ->add('categorie', EntityType::class, array(
                'label' => 'Catégorie de l\'annonce',
                'class' => 'LSIMarketBundle:Categorie',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Sélectionner une catégorie',
            ))
            ->add('typeAnnul', ChoiceType::class, array(
                'label' => 'Type d\'annulation',
                'placeholder' => 'Sélectionner le type d\'annulation',
                'choices' => array(
                    'Relax' => 'relax',
                    'Strict' => 'strict'
                )
            ))
            ->add('assurances', TextType::class)
            ->add('save', SubmitType::class, array())
        ;
        $builder
            ->remove('dateCreation')
            ->remove('heureCreation')
            ->remove('annonceUpdateAt')
            ->remove('mairie')
            ->remove('pulicMairie')
            ->remove('pulicAdministre')
            ->remove('tarifAdminisEpci')
            ->remove('tarifNonAdminisEpci')
            ->remove('tarifNonAdmins')
            ->remove('tarifEpci')
            ->remove('tarifNonEpci')
            //->remove('dateCreation')
            ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event){
                $annonce = $event->getForm();

                if ($annonce != null){
                    $event->getForm()->get('adresse')->remove('departement');
                }

            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Annonce'
        ));
    }


    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_annonce';
    }


}
