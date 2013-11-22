<?php

namespace Iteo\Bundle\FormFilterBundle\Condition\Type;

interface ConditionTypeInterface
{
    public function getField();

    public function getFilterName();

    public function getConfigurationFormType();
}
