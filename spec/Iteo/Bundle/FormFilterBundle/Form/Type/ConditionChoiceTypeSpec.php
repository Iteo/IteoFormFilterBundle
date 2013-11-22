<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConditionChoiceTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array('choice1', 'choice2'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\Type\ConditionChoiceType');
    }

    function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    function it_should_set_condition_types_to_choose_from($resolver)
    {
        $resolver->setDefaults(array('choices' => array('choice1', 'choice2')))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
