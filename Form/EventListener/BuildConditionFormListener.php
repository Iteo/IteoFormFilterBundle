<?php

namespace Iteo\Bundle\FormFilterBundle\Form\EventListener;

use Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface;
use Iteo\Bundle\FormFilterBundle\Model\ConditionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class BuildConditionFormListener implements EventSubscriberInterface
{
    /**
     * @var \Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface
     */
    private $conditionTypeRegistry;
    private $factory;

    public function __construct(ConditionTypeRegistryInterface $conditionTypeRegistry, FormFactoryInterface $factory)
    {
        $this->conditionTypeRegistry = $conditionTypeRegistry;
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND => 'preBind'
        );
    }

    public function preSetData(FormEvent $event)
    {
        /* @var $condition ConditionInterface */
        $condition = $event->getData();

        if (null === $condition || null === $condition->getType()) {
            return;
        }

        $this->addConfigurationFields($event->getForm(), $condition->getType(), $condition->getConfiguration());
    }

    public function preBind(FormEvent $event)
    {
        $data = $event->getData();

        if (empty($data) || !array_key_exists('type', $data)) {
            return;
        }

        $this->addConfigurationFields($event->getForm(), $data['type']);
    }

    protected function addConfigurationFields(FormInterface $form, $type, array $data = array())
    {
        $conditionType = $this->conditionTypeRegistry->getType($type);
        $configurationField = $this->factory->createNamed(
            'configuration',
            $conditionType->getConfigurationFormType(),
            $data,
            array(
                //'auto_initialize' => false
            )
        );

        $form->add($configurationField);
    }
}
