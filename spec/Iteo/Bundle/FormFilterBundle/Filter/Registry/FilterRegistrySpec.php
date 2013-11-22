<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Registry;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilterRegistrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistry');
    }

    function it_should_be_filter_registry()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistryInterface');
    }

    function it_should_initialize_filters_array_by_default()
    {
        $this->getFilters()->shouldReturn(array());
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    function it_should_register_filter_under_given_name($filter)
    {
        $this->hasFilter('datetime')->shouldReturn(false);
        $this->registerFilter('datetime', $filter);
        $this->hasFilter('datetime')->shouldReturn(true);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    function it_should_complain_if_trying_register_filter_with_taken_name($filter)
    {
        $this->registerFilter('datetime', $filter);

        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\ExistingFilterException')
            ->duringRegisterFilter('datetime', $filter);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    function it_should_unregister_filter_with_given_name($filter)
    {
        $this->registerFilter('datetime', $filter);
        $this->hasFilter('datetime')->shouldReturn(true);

        $this->unregisterFilter('datetime');
        $this->hasFilter('datetime')->shouldReturn(false);
    }

    function it_should_complain_if_trying_unregister_non_existing_filter()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\NonExistingFilterException')
            ->duringUnregisterFilter('non_existing');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    function it_should_retrieve_registered_filter_by_name($filter)
    {
        $this->registerFilter('datetime', $filter);
        $this->getFilter('datetime')->shouldReturn($filter);
    }

    function it_should_complain_if_trying_retrieve_non_existing_filter()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\NonExistingFilterException')
            ->duringGetFilter('non_existing');
    }
}
