<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\FilterInterface;
use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

abstract class Filter implements FilterInterface
{
    /**
     *
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     * @param $field
     * @return string
     */
    protected function getNewParameterName(QueryInterface $query, $field)
    {
        // dots are not accepted in a DQL identifier so replace them
        // by underscores.
        return str_replace('.', '_', $field) . '_' . $query->getUniqueParameterId();
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     * @param mixed                                                     $parameter
     */
    protected function applyWhere(QueryInterface $query, $parameter)
    {
        $query->andWhere($parameter);
    }
}
