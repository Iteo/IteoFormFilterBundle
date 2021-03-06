<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter;

use PhpSpec\ObjectBehavior;

class FilterControllerSpec extends ObjectBehavior
{

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistry $filterRegistry
     */
    public function let($filterRegistry)
    {
        $this->beConstructedWith($filterRegistry);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\FilterController');
    }

    public function it_should_be_filter_manager()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\FilterControllerInterface');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistry $filterRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface         $filter
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface    $query
     */
    public function it_should_run_filter_for_given_filter_name($filterRegistry, $filter, $query)
    {
        $name = 'filter';
        $field = 'field';
        $data = array('key' => 'value');
        $filterRegistry->getFilter($name)->willReturn($filter);

        $this->filter($query, $name, $field, $data);

        $filter->filter($query, $field, $data)->shouldBeCalled();
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistry $filterRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterInterface         $filter
     */
    public function it_should_run_is_active_for_given_filter_name($filterRegistry, $filter)
    {
        $name = 'filter';
        $data = array('key' => 'value');
        $filterRegistry->getFilter($name)->willReturn($filter);
        $filter->isActive($data)->willReturn(true);

        $this->isActive($name, $data)->shouldReturn(true);
        $filter->isActive($data)->shouldBeCalled();
    }
}
