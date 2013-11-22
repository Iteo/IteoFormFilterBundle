<?php

namespace Iteo\Bundle\FormFilterBundle\Condition;

interface ConditionInterface
{
    public function getType();

    public function getConfiguration();
}
