<?php

namespace Iteo\Bundle\FormFilterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConditionChoiceType extends AbstractType
{
    protected $conditionTypes;

    public function __construct(array $conditionTypes)
    {
        $this->conditionTypes = $conditionTypes;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'choices' => $this->conditionTypes
                )
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'iteo_form_filter_condition_choice';
    }
}
