<?php

namespace LSI\MarketBundle\Form;

use LSI\MarketBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
            //->add('nom')
            ->add('dateInscription')



        ;

        // Evene;ent sur le for;ulqire
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event){
                // R2cup7re le user connecter pour modifier le formulaire
                $user = $event->getForm()->getConfig()->getOptions()['user'];
                $membre = $event->getForm(); // recupere le formulaire

                if ($user->getMairie()){ // Teste si le user est une mairie
                    // Si oui ajoute les champs membre et le bouton de soumission
                    $membre->add('membre', MembreType::class, array(
                        'label'=> false,
                    ));
                    $membre->add('Ajouter', SubmitType::class, array(
                        'attr' => array(
                            'class' => 'form-control btn btn-primary'
                        )
                    ));
                }else {
                    //Si non ajoute le bouton de soumission
                    $membre->add('Ajouter', SubmitType::class, array(
                        'attr' => array(
                            'class' => 'form-control btn btn-primary'
                        )
                    ));
                }
            }
        );

        $builder
            ->remove('nom')
            ->remove('dateInscription')
            ->remove('indicatif')
            ->remove('dateModif')
            ->remove('langue')
            ->remove('telephone')
            ->remove('mairie')
            ->remove('administre')
            ->remove('adresse')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\User'
        ))
            ->setRequired(array('user')) // Ajoute le parametre fournit au formulaire ds les options
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * {@inheritdoc}
     *
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_user';
    }*/


}
