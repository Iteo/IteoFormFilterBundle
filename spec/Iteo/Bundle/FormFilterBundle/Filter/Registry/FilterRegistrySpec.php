<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Registry;

use PhpSpec\ObjectBehavior;

class FilterRegistrySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistry');
    }

    public function it_should_be_filter_registry()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistryInterface');
    }

    public function it_should_initialize_filters_array_by_default()
    {
        $this->getFilters()->shouldReturn(array());
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    public function it_should_register_filter_under_given_name($filter)
    {
        $this->hasFilter('datetime')->shouldReturn(false);
        $this->registerFilter('datetime', $filter);
        $this->hasFilter('datetime')->shouldReturn(true);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    public function it_should_complain_if_trying_register_filter_with_taken_name($filter)
    {
        $this->registerFilter('datetime', $filter);

        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\ExistingFilterException')
            ->duringRegisterFilter('datetime', $filter);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    public function it_should_unregister_filter_with_given_name($filter)
    {
        $this->registerFilter('datetime', $filter);
        $this->hasFilter('datetime')->shouldReturn(true);

        $this->unregisterFilter('datetime');
        $this->hasFilter('datetime')->shouldReturn(false);
    }

    public function it_should_complain_if_trying_unregister_non_existing_filter()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\NonExistingFilterException')
            ->duringUnregisterFilter('non_existing');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface $filter
     */
    public function it_should_retrieve_registered_filter_by_name($filter)
    {
        $this->registerFilter('datetime', $filter);
        $this->getFilter('datetime')->shouldReturn($filter);
    }

    public function it_should_complain_if_trying_retrieve_non_existing_filter()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Filter\Registry\NonExistingFilterException')
            ->duringGetFilter('non_existing');
    }
}
