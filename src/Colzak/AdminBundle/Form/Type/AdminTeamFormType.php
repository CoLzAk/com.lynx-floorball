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
            ->add('teamLogo', 'file')
            ->add('pool', 'choice', array(
                    'label' => 'Poule',
                    'choices' => Team::getPoolList()
                ))
            ->add('point', 'number', array('label' => 'Points'))
            ->add('gamePlayed', 'number', array('label' => 'Matches joués'))
            ->add('goalScored', 'number', array('label' => 'But marqués'))
            ->add('goalLet', 'number', array('label' => 'But encaissés'))
            ->add('win', 'number', array('label' => 'Matches gagnés'))
            ->add('defeat', 'number', array('label' => 'Matches perdus'))
            ->add('draw', 'number', array('label' => 'Matches nuls'))
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