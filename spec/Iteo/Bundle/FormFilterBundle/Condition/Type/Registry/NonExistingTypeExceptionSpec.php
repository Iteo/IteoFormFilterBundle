<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

use PhpSpec\ObjectBehavior;

class NonExistingTypeExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('condition_type_name');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\NonExistingTypeException');
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
