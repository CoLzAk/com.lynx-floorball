<?php

namespace Colzak\HomeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\HomeBundle\Document\Message;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'text', array('label' => 'Ton adresse e-mail'))
            ->add('subject', 'text', array('label' => 'Sujet'))
            ->add('body', 'textarea', array('label' => 'Ton message'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\HomeBundle\Document\Message',
        ));
    }

    public function getName()
    {
        return 'colzak_contact';
    }
}