<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Registry;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExistingFilterExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('filter_name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Registry\ExistingFilterException');
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
