<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\Type;

use PhpSpec\ObjectBehavior;

class ConditionChoiceTypeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array('choice1', 'choice2'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\Type\ConditionChoiceType');
    }

    public function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function it_should_set_condition_types_to_choose_from($resolver)
    {
        $resolver->setDefaults(array('choices' => array('choice1', 'choice2')))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }
}
