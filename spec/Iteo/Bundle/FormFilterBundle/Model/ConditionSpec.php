<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Model;

use PhpSpec\ObjectBehavior;

class ConditionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Model\Condition');
    }

    public function it_should_be_a_condition()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Model\ConditionInterface');
    }

    public function it_should_not_have_type_by_default()
    {
        $this->getType()->shouldReturn(null);
    }

    public function its_type_should_be_mutable()
    {
        $this->setType('condition_type');
        $this->getType()->shouldReturn('condition_type');
    }

    public function it_should_initialize_array_for_configuration_by_default()
    {
        $this->getConfiguration()->shouldReturn(array());
    }

    public function its_configuration_should_be_mutable()
    {
        $this->setConfiguration(array('value' => 500));
        $this->getConfiguration()->shouldReturn(array('value' => 500));
    }
}
