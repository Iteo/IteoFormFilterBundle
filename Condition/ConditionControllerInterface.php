<?php

namespace Iteo\Bundle\FormFilterBundle\Condition;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

interface ConditionControllerInterface
{
    public function filter(QueryInterface $query, $conditions = array());

    public function filterCondition(QueryInterface $query, ConditionInterface $condition);

    public function getActiveConditions($conditions = array());

    public function isActive(ConditionInterface $condition);
}
