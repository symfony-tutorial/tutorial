<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('label')
                ->add('parent', 'entity', array('label' => 'parent category',
                    'class' => Category::REPOSITORY,
                    'choice_label' => 'label',
                ))
                ->add('save', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category',
        ));
    }

    public function getName()
    {
        return 'app_category';
    }

}
