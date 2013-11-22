<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\Type\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringConfigurationTypeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\Type\Filter\StringConfigurationType');
    }

    public function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     */
    public function it_should_build_form_with_operator_and_value_fields($builder)
    {
        $builder
            ->add('type', 'choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);
        $builder
            ->add('value', 'text', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array('field_options' => array()));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function it_should_initialize_field_options_be_default($resolver)
    {
        $resolver->setDefaults(Argument::withKey('field_options'))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
