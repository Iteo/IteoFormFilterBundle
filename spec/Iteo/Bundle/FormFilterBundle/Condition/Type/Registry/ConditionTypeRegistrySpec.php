<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

use PhpSpec\ObjectBehavior;

class ConditionTypeRegistrySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistry');
    }

    public function it_should_be_condition_type_registry()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface');
    }

    public function it_should_initialize_types_array_by_default()
    {
        $this->getTypes()->shouldReturn(array());
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface $type
     */
    public function it_should_register_type_under_given_name($type)
    {
        $this->hasType('datetime')->shouldReturn(false);
        $this->registerType('datetime', $type);
        $this->hasType('datetime')->shouldReturn(true);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface $type
     */
    public function it_should_complain_if_trying_register_type_with_taken_name($type)
    {
        $this->registerType('creation_date', $type);

        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ExistingTypeException')
            ->duringRegisterType('creation_date', $type);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface $type
     */
    public function it_should_unregister_type_with_given_name($type)
    {
        $this->registerType('creation_date', $type);
        $this->hasType('creation_date')->shouldReturn(true);

        $this->unregisterType('creation_date');
        $this->hasType('creation_date')->shouldReturn(false);
    }

    public function it_should_complain_if_trying_unregister_non_existing_type()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\NonExistingTypeException')
            ->duringUnregisterType('non_existing');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface $type
     */
    public function it_should_retrieve_registered_type_by_name($type)
    {
        $this->registerType('creation_date', $type);
        $this->getType('creation_date')->shouldReturn($type);
    }

    public function it_should_complain_if_trying_retrieve_non_existing_type()
    {
        $this->shouldThrow('Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\NonExistingTypeException')
            ->duringGetType('non_existing');
    }
}
