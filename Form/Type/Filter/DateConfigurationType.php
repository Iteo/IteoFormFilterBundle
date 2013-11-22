<?php

namespace Iteo\Bundle\FormFilterBundle\Form\Type\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\DateFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateConfigurationType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array(
            DateFilter::TYPE_EQUAL            => 'date_type_equal',
            DateFilter::TYPE_GREATER_EQUAL    => 'date_type_greater_equal',
            DateFilter::TYPE_GREATER_THAN     => 'date_type_greater_than',
            DateFilter::TYPE_LESS_EQUAL       => 'date_type_less_equal',
            DateFilter::TYPE_LESS_THAN        => 'date_type_less_than',
            DateFilter::TYPE_NULL             => 'date_type_null',
            DateFilter::TYPE_NOT_NULL         => 'date_type_not_null',
        );

        $builder
            ->add('type', 'choice', array('choices' => $choices, 'required' => false))
            ->add('value', 'date', array_merge(array('required' => false), $options['field_options']))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'field_options' => array('format' => 'yyyy-MM-dd')
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'iteo_type_filter_date_configuration';
    }
}
