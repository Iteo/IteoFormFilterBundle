<?php

namespace Iteo\Bundle\FormFilterBundle\Form\Type\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\StringFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StringConfigurationType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array(
            StringFilter::TYPE_CONTAINS         => 'string_type_contains',
            StringFilter::TYPE_NOT_CONTAINS     => 'string_type_not_contains',
            StringFilter::TYPE_EQUAL            => 'string_type_equal',
        );

        $builder
            ->add('type', 'choice', array('choices' => $choices, 'required' => false))
            ->add('value', 'text', array_merge(array('required' => false), $options['field_options']))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'field_options' => array()
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'iteo_type_filter_string_configuration';
    }
}
