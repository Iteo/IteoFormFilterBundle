<?php

namespace Iteo\Bundle\FormFilterBundle\Condition;

use Iteo\Bundle\FormFilterBundle\Condition\Type\Registry\ConditionTypeRegistryInterface;
use Iteo\Bundle\FormFilterBundle\Filter\FilterControllerInterface;
use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class ConditionController implements ConditionControllerInterface
{
    /**
     * @var \Iteo\Bundle\FormFilterBundle\Filter\FilterControllerInterface
     */
    protected $filterController;

    /**
     * @var Type\Registry\ConditionTypeRegistryInterface
     */
    protected $registry;

    public function __construct(FilterControllerInterface $filterController, ConditionTypeRegistryInterface $registry)
    {
        $this->filterController = $filterController;
        $this->registry = $registry;
    }

    public function filter(QueryInterface $query, $conditions = array())
    {
        if (!is_array($conditions)) {
            $conditions = array($conditions);
        }

        foreach ($conditions as $condition) {
            $this->filterCondition($query, $condition);
        }
    }

    public function filterCondition(QueryInterface $query, ConditionInterface $condition)
    {
        $type = $this->registry->getType($condition->getType());

        $this->filterController->filter(
            $query,
            $type->getFilterName(),
            $type->getField(),
            $condition->getConfiguration()
        );
    }

    public function getActiveConditions($conditions = array())
    {
        if (!is_array($conditions)) {
            $conditions = array($conditions);
        }

        $active = array();

        foreach ($conditions as $condition) {
            if ($this->isActive($condition)) {
                $active[] = $condition;
            }
        }

        return $active;
    }

    public function isActive(ConditionInterface $condition)
    {
        $type = $this->registry->getType($condition->getType());

        return $this->filterController->isActive($type->getFilterName(), $condition->getConfiguration());
    }
}
