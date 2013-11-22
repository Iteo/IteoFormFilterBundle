<?php

namespace Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

use Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface;

interface ConditionTypeRegistryInterface
{

    public function getTypes();

    public function registerType($name, ConditionTypeInterface $filter);

    public function hasType($name);

    public function unregisterType($name);

    /**
     * @param $name
     * @return ConditionTypeInterface
     */
    public function getType($name);
}
