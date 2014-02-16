<?php

namespace Colzak\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\UserBundle\Document\User;

class AdminUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('label' => 'Nom d\'utilisateur'))
            ->add('email', 'text', array('label' => 'Adresse e-mail'))
            ->add('password', 'text', array('label' => 'Mot de passe'))
            ->add('firstname', 'text', array('label' => 'Prénom'))
            ->add('lastname', 'text', array('label' => 'Nom'))
            ->add('position', 'choice', array(
                    'label' => 'Position',
                    'choices' => User::getPositionList()
                ))
            ->add('number', 'number', array('label' => 'Numéro'))
            ->add('userPicture', 'file')
            // ->add('roles')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\UserBundle\Document\User',
        ));
    }

    public function getName()
    {
        return 'colzak_admin_user';
    }
}