<?php

namespace Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

/**
 * This exception should be thrown by condition type registry
 * when condition type of given type does not exist.
 */
class NonExistingTypeException extends \InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('ConditionType of type "%s" does not exist.', $type));
    }
}
