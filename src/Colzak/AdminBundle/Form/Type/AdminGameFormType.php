<?php

namespace Colzak\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\EventBundle\Document\Game;

class AdminGameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team1', 'document', array(
                'class' => 'Colzak\EventBundle\Document\Team',
                'property' => 'name'
            ))
            ->add('team2', 'document', array(
                'class' => 'Colzak\EventBundle\Document\Team',
                'property' => 'name'
            ))
            ->add('place', 'text', array('label' => 'Lieu'))
            ->add('date', 'date', array('label' => 'Date'))
            ->add('team1Score', null, array('required' => false))
            ->add('team2Score', null, array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\EventBundle\Document\Game',
        ));
    }

    public function getName()
    {
        return 'colzak_admin_game';
    }
}