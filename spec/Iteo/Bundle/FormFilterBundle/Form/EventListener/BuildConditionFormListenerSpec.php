<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\EventListener;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuildConditionFormListenerSpec extends ObjectBehavior
{
    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface $conditionTypeRegistry
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface                  $conditionType
     * @param \Symfony\Component\Form\FormFactoryInterface                                         $factory
     */
    public function let($conditionTypeRegistry, $conditionType, $factory)
    {
        $conditionType->getConfigurationFormType()->willReturn('iteo_form_filter_condition_created_at_type_configuration');
        $conditionTypeRegistry->getType(Argument::any())->willReturn($conditionType);

        $this->beConstructedWith($conditionTypeRegistry, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\EventListener\BuildConditionFormListener');
    }

    public function it_should_be_event_subscriber()
    {
        $this->shouldImplement('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    /**
     * @param \Symfony\Component\Form\FormFactoryInterface           $factory
     * @param \Symfony\Component\Form\FormEvent                      $event
     * @param \Iteo\Bundle\FormFilterBundle\Model\ConditionInterface $condition
     * @param \Symfony\Component\Form\Form                           $form
     * @param \Symfony\Component\Form\Form                           $field
     */
    public function it_should_add_configuration_fields_in_pre_set_data($factory, $event, $condition, $form, $field)
    {
        $event->getData()->shouldBeCalled()->willReturn($condition);
        $event->getForm()->shouldBeCalled()->willReturn($form);
        $condition->getType()->shouldBeCalled()->willReturn('condition_type');
        $condition->getConfiguration()->shouldBeCalled()->willReturn(array());

        $factory->createNamed('configuration', 'iteo_form_filter_condition_created_at_type_configuration', Argument::cetera())->shouldBeCalled()->willReturn($field);
        $form->add($field)->shouldBeCalled();

        $this->preSetData($event);
    }
}
