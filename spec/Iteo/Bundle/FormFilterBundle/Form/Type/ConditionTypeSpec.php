<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConditionTypeSpec extends ObjectBehavior
{
    /**
     * @param \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface $conditionTypeRegistry
     */
    public function let($conditionTypeRegistry)
    {
        $this->beConstructedWith('Condition', $conditionTypeRegistry);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Form\Type\ConditionType');
    }

    public function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param \Symfony\Component\Form\FormFactoryInterface $factory
     */
    public function it_should_build_form_with_condition_type_choice_field($builder, $factory)
    {
        $builder->addEventSubscriber(Argument::any())->willReturn($builder);
        $builder->getFormFactory()->willReturn($factory);

        $builder
            ->add('type', 'iteo_form_filter_condition_choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array());
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function it_should_define_assigned_data_class($resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Condition'))->shouldBeCalled();

        $this->setDefaultOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilder          $builder
     * @param \Symfony\Component\Form\FormFactoryInterface $factory
     */
    public function it_should_add_build_condition_event_subscriber($builder, $factory)
    {
        $builder->add(Argument::any(), Argument::any(), Argument::any())->willReturn($builder);
        $builder->getFormFactory()->willReturn($factory);

        $builder
            ->addEventSubscriber(
                Argument::type('Iteo\Bundle\FormFilterBundle\Form\EventListener\BuildConditionFormListener')
            )
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array());
    }
}
