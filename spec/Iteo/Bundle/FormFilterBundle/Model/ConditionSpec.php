<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConditionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Model\Condition');
    }

    function it_should_be_a_condition()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Model\ConditionInterface');
    }

    function it_should_not_have_type_by_default()
    {
        $this->getType()->shouldReturn(null);
    }

    function its_type_should_be_mutable()
    {
        $this->setType('condition_type');
        $this->getType()->shouldReturn('condition_type');
    }

    function it_should_initialize_array_for_configuration_by_default()
    {
        $this->getConfiguration()->shouldReturn(array());
    }

    function its_configuration_should_be_mutable()
    {
        $this->setConfiguration(array('value' => 500));
        $this->getConfiguration()->shouldReturn(array('value' => 500));
    }
}
