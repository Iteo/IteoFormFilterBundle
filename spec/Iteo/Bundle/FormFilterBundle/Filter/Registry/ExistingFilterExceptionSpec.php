<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Registry;

use PhpSpec\ObjectBehavior;

class ExistingFilterExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('filter_name');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Registry\ExistingFilterException');
    }

    public function it_should_be_an_exception()
    {
        $this->shouldHaveType('Exception');
    }

    public function it_should_be_a_invalid_argument_exception()
    {
        $this->shouldHaveType('InvalidArgumentException');
    }
}
