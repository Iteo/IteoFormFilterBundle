<?php

namespace Iteo\Bundle\FormFilterBundle\Model;

use Iteo\Bundle\FormFilterBundle\Condition\ConditionInterface as BaseConditionInterface;

interface ConditionInterface extends BaseConditionInterface
{
    public function getType();

    public function setType($type);

    public function getConfiguration();

    public function setConfiguration(array $configuration);
}
