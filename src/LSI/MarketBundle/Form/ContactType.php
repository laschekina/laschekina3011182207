<?php

namespace LSI\MarketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactFirstname')
            ->add('contactSecondname')
            ->add('contactImage',FileType::class)
            ->add('contactEmail',EmailType::class)
            ->add('contactMessage',TextareaType::class)
            ->add('contactLocation',TextareaType::class)
            ->add('contactPhone',TextareaType::class)
            ->add('contactContext',HiddenType::class)
            ->add('contactContextId',HiddenType::class)
            ->add('Envoyer',SubmitType::class);

        $builder
            ->remove('contactSecondname')
            ->remove('contactImage')
            ->remove('contactPhone')
            ->remove('contactLocation')
            ->remove('contactContext')
            ->remove('contactContextId')
            ->remove('Envoyer');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LSI\MarketBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lsi_marketbundle_contact';
    }


}
