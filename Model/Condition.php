<?php

namespace Iteo\Bundle\FormFilterBundle\Model;

class Condition implements ConditionInterface
{
    protected $type;
    protected $configuration;

    public function __construct()
    {
        $this->configuration = array();
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;
    }
}
