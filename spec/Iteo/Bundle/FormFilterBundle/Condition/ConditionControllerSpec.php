<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Condition;

use PhpSpec\ObjectBehavior;

class ConditionControllerSpec extends ObjectBehavior
{

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     */
    public function let($filterController, $conditionRegistry)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Condition\ConditionController');
    }

    public function it_should_be_condition_controller()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Condition\ConditionControllerInterface');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_allow_to_filter_query_with_empty_array_of_conditions($query)
    {
        $this->filter($query, array());
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface                   $query
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition
     */
    public function it_should_filter_one_condition_proper($filterController, $conditionRegistry, $conditionType, $query, $condition)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);

        $configuration = array('value1' => 0, 'value2' => 'string');

        $condition->getType()->willReturn('field_condition_type');
        $condition->getConfiguration()->willReturn($configuration);

        $conditionType->getField()->willReturn('field_name');
        $conditionType->getFilterName()->willReturn('filter_name');
        $conditionRegistry->getType('field_condition_type')->willReturn($conditionType);

        $this->filter($query, array($condition));

        $filterController->filter($query, 'filter_name', 'field_name', $configuration)->shouldBeCalled();
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface                   $query
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition
     */
    public function it_should_filter_object_condition_proper($filterController, $conditionRegistry, $conditionType, $query, $condition)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);

        $configuration = array('value1' => 0, 'value2' => 'string');

        $condition->getType()->willReturn('field_condition_type');
        $condition->getConfiguration()->willReturn($configuration);

        $conditionType->getField()->willReturn('field_name');
        $conditionType->getFilterName()->willReturn('filter_name');
        $conditionRegistry->getType('field_condition_type')->willReturn($conditionType);

        $this->filter($query, $condition);

        $filterController->filter($query, 'filter_name', 'field_name', $configuration)->shouldBeCalled();
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType1
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface                   $query
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition1
     */
    public function it_should_filter_conditions_proper($filterController, $conditionRegistry, $conditionType, $conditionType1, $query, $condition, $condition1)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);

        $configuration = array('value1' => 0, 'value2' => 'string');
        $configuration1 = array('value2' => 0.0, 'value3' => 'text');

        $condition->getType()->willReturn('field_condition_type');
        $condition->getConfiguration()->willReturn($configuration);
        $conditionType->getField()->willReturn('field_name');
        $conditionType->getFilterName()->willReturn('filter_name');
        $conditionRegistry->getType('field_condition_type')->willReturn($conditionType);

        $condition1->getType()->willReturn('field_condition_type1');
        $condition1->getConfiguration()->willReturn($configuration1);
        $conditionType1->getField()->willReturn('field_name1');
        $conditionType1->getFilterName()->willReturn('filter_name1');
        $conditionRegistry->getType('field_condition_type1')->willReturn($conditionType1);

        $this->filter($query, array($condition, $condition1));

        $filterController->filter($query, 'filter_name', 'field_name', $configuration)->shouldBeCalled();
        $filterController->filter($query, 'filter_name1', 'field_name1', $configuration1)->shouldBeCalled();
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType1
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition1
     */
    public function it_should_return_array_of_active_conditions($filterController, $conditionRegistry, $conditionType, $conditionType1, $condition, $condition1)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);

        $configuration = array('value1' => 0, 'value2' => 'string');
        $configuration1 = array('value2' => 0.0, 'value3' => 'text');

        $condition->getType()->willReturn('field_condition_type');
        $condition->getConfiguration()->willReturn($configuration);
        $conditionType->getField()->willReturn('field_name');
        $conditionType->getFilterName()->willReturn('filter_name');
        $conditionRegistry->getType('field_condition_type')->willReturn($conditionType);

        $condition1->getType()->willReturn('field_condition_type1');
        $condition1->getConfiguration()->willReturn($configuration1);
        $conditionType1->getField()->willReturn('field_name1');
        $conditionType1->getFilterName()->willReturn('filter_name1');
        $conditionRegistry->getType('field_condition_type1')->willReturn($conditionType1);

        $filterController->isActive('filter_name', $configuration)->willReturn(true);
        $filterController->isActive('filter_name1', $configuration1)->willReturn(false);

        $this->getActiveConditions(array($condition, $condition1))->shouldReturn(array($condition));
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\FilterController                       $filterController
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry $conditionRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface         $conditionType
     * @param \Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface                  $condition
     */
    public function it_should_run_is_active_for_given_filter_name($filterController, $conditionRegistry, $conditionType, $condition)
    {
        $this->beConstructedWith($filterController, $conditionRegistry);

        $configuration = array('value1' => 0, 'value2' => 'string');
        $condition->getType()->willReturn('field_condition_type');
        $condition->getConfiguration()->willReturn($configuration);
        $conditionType->getField()->willReturn('field_name');
        $conditionType->getFilterName()->willReturn('filter_name');
        $conditionRegistry->getType('field_condition_type')->willReturn($conditionType);

        $filterController->isActive('filter_name', $configuration)->willReturn(true);
        $this->isActive($condition)->shouldReturn(true);
        $filterController->isActive('filter_name', $configuration)->shouldBeCalled();
    }

}
