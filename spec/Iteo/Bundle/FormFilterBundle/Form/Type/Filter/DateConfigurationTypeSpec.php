<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\Type\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateConfigurationTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\Type\Filter\DateConfigurationType');
    }

    function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    function it_should_build_form_with_operator_and_value_fields($builder)
    {
        $builder
            ->add('type', 'choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);
        $builder
            ->add('value', 'date', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array('field_options' => array()));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_should_initialize_field_options_be_default($resolver)
    {
        $resolver->setDefaults(Argument::withKey('field_options'))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
