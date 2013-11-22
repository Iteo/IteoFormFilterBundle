<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Registry;

/**
 * This exception should be thrown by filter registry
 * when filter of given type does not exist.
 */
class NonExistingFilterException extends \InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('Filter of type "%s" does not exist.', $type));
    }
}
