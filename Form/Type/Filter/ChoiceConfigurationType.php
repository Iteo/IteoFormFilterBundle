<?php

namespace Iteo\Bundle\FormFilterBundle\Form\Type\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\ChoiceFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoiceConfigurationType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array('choices' => $options['choices'], 'required' => false, 'empty_value' => $options['type_empty_value']))
            ->add('value', 'choice', array_merge(array('required' => false), $options['field_options']))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'type_empty_value' => true,
                'choices' => array(
                    ChoiceFilter::TYPE_CONTAINS         => 'choice_type_contains',
                    ChoiceFilter::TYPE_NOT_CONTAINS     => 'choice_type_not_contains',
                    ChoiceFilter::TYPE_EQUAL            => 'choice_type_equal',
                ),
                'field_options' => array()
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'iteo_type_filter_choice_configuration';
    }
}

