<?php

namespace Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

/**
 * This exception should be thrown by condition type registry
 * when condition type of given type already exists.
 */
class ExistingTypeException extends \InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('ConditionType of type "%s" already exist.', $type));
    }
}
