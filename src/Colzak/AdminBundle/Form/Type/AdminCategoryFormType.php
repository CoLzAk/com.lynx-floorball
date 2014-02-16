<?php

namespace Colzak\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\BlogBundle\Document\Category;

class AdminCategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('parent', 'document', array(
                'class' => 'Colzak\BlogBundle\Document\Category',
                'property' => 'name',
                'required' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\BlogBundle\Document\Category',
        ));
    }

    public function getName()
    {
        return 'colzak_admin_category';
    }
}