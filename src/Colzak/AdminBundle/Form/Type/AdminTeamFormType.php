<?php

namespace Colzak\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\EventBundle\Document\Team;

class AdminTeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('teamLogo', 'file', array('label' => 'Logo', 'required' => false))
            ->add('pool', 'choice', array(
                    'label' => 'Poule',
                    'choices' => Team::getPoolList()
                ))
            ->add('point', 'number', array('label' => 'Points', 'required' => false))
            ->add('gamePlayed', 'number', array('label' => 'Matches joués', 'required' => false))
            ->add('goalScored', 'number', array('label' => 'But marqués', 'required' => false))
            ->add('goalLet', 'number', array('label' => 'But encaissés', 'required' => false))
            ->add('win', 'number', array('label' => 'Matches gagnés', 'required' => false))
            ->add('defeat', 'number', array('label' => 'Matches perdus', 'required' => false))
            ->add('draw', 'number', array('label' => 'Matches nuls', 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\EventBundle\Document\Team',
        ));
    }

    public function getName()
    {
        return 'colzak_admin_team';
    }
}