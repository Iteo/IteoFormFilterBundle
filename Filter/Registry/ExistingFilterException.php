<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Registry;

/**
 * This exception should be thrown by filter registry
 * when filter of given type already exists.
 */
class ExistingFilterException extends \InvalidArgumentException
{
    public function __construct($type)
    {
        parent::__construct(sprintf('Filter of type "%s" already exist.', $type));
    }
}
