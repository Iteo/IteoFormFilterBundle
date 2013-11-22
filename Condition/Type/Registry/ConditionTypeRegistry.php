<?php

namespace Iteo\Bundle\FormFilterBundle\Condition\Type\Registry;

use Iteo\Bundle\FormFilterBundle\Condition\Type\ConditionTypeInterface;

class ConditionTypeRegistry implements ConditionTypeRegistryInterface
{
    /**
     * @var array
     */
    protected $types;

    public function __construct()
    {
        $this->types = array();
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function registerType($name, ConditionTypeInterface $type)
    {
        if ($this->hasType($name)) {
            throw new ExistingTypeException($name);
        }
        $this->types[$name] = $type;
    }

    public function hasType($name)
    {
        return isset($this->types[$name]);
    }

    public function unregisterType($name)
    {
        if (!$this->hasType($name)) {
            throw new NonExistingTypeException($name);
        }

        unset($this->types[$name]);
    }

    public function getType($name)
    {
        if (!$this->hasType($name)) {
            throw new NonExistingTypeException($name);
        }

        return $this->types[$name];
    }
}
