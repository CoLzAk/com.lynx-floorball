<?php

namespace Colzak\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Colzak\BlogBundle\Document\Category;

class AdminArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Titre'))
            ->add('content', 'textarea', array('label' => 'Contenu'))
            ->add('category', 'document', array(
                'class' => 'Colzak\BlogBundle\Document\Category',
                'property' => 'name',
                'required' => false
            ))
            ->add('file', 'file', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Colzak\BlogBundle\Document\Article',
        ));
    }

    public function getName()
    {
        return 'colzak_admin_article';
    }
}