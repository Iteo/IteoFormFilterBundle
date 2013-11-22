<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExistingTypeExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('condition_type_name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ExistingTypeException');
    }

    function it_should_be_an_exception()
    {
        $this->shouldHaveType('Exception');
    }

    function it_should_be_a_invalid_argument_exception()
    {
        $this->shouldHaveType('InvalidArgumentException');
    }
}
