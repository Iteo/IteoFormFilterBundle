<?php

namespace Iteo\Bundle\FormFilterBundle\Form\Type;

use Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface;
use Iteo\Bundle\FormFilterBundle\Form\EventListener\BuildConditionFormListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConditionType extends AbstractType
{
    protected $class;
    /**
     * @var \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface
     */
    protected $conditionTypeRegistry;

    public function __construct($class, ConditionTypeRegistryInterface $conditionTypeRegistry)
    {
        $this->class = $class;
        $this->conditionTypeRegistry = $conditionTypeRegistry;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new BuildConditionFormListener($this->conditionTypeRegistry, $builder->getFormFactory()))
            ->add('type', 'iteo_form_filter_condition_choice', array(
                    'label' => 'condition_type_label',
                ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'iteo_form_filter_condition';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->class
            )
        );
    }


}
