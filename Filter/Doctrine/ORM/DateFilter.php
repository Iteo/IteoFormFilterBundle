<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class DateFilter extends Filter
{
    const TYPE_GREATER_EQUAL = 'greater_equal';
    const TYPE_GREATER_THAN = 'greater_than';
    const TYPE_EQUAL = 'equal';
    const TYPE_LESS_EQUAL = 'less_equal';
    const TYPE_LESS_THAN = 'less_than';
    const TYPE_NULL = 'null';
    const TYPE_NOT_NULL = 'not_null';

    public function filter(QueryInterface $query, $field, $data)
    {
        if (!$this->isActive($data)) {
            return;
        }

        //default type for simple filter
        $data['type'] = !isset($data['type']) ? self::TYPE_EQUAL : $data['type'];

        //just find an operator and apply query
        $operator = $this->getOperator($data['type']);

        //null / not null only check for col
        if (in_array($operator, array('NULL', 'NOT NULL'))) {
            $this->applyWhere($query, sprintf('%s IS %s', $field, $operator));
        } elseif ($data['type'] == self::TYPE_EQUAL) {
            $start = clone $data['value'];
            $start->setTime(0, 0, 0);

            $end = clone $data['value'];
            $end->setTime(23, 59, 59);

            $startParameterName = $this->getNewParameterName($query, $field);

            $this->applyWhere($query, sprintf('%s >= :%s', $field, $startParameterName));
            $query->setParameter($startParameterName, $start);

            $endParameterName = $this->getNewParameterName($query, $field);

            $this->applyWhere($query, sprintf('%s <= :%s', $field, $endParameterName));
            $query->setParameter($endParameterName, $end);

        } else {
            $parameterName = $this->getNewParameterName($query, $field);

            $this->applyWhere($query, sprintf('%s %s :%s', $field, $operator, $parameterName));
            $query->setParameter($parameterName, $data['value']);
        }
    }

    /**
     * Resolves DataType:: constants to SQL operators
     *
     * @param string $type
     *
     * @return string
     */
    protected function getOperator($type)
    {
        $choices = array(
            self::TYPE_EQUAL => '=',
            self::TYPE_GREATER_EQUAL => '>=',
            self::TYPE_GREATER_THAN => '>',
            self::TYPE_LESS_EQUAL => '<=',
            self::TYPE_LESS_THAN => '<',
            self::TYPE_NULL => 'NULL',
            self::TYPE_NOT_NULL => 'NOT NULL',
        );

        return isset($choices[$type]) ? $choices[$type] : '=';
    }

    public function isActive($data)
    {
        if (!$data || !is_array($data) || !array_key_exists('value', $data)) {
            return false;
        }

        $data['type'] = !isset($data['type']) ? self::TYPE_EQUAL : $data['type'];
        $operator = $this->getOperator($data['type']);
        if (!in_array($operator, array('NULL', 'NOT NULL'))) {
            if (!$data['value']) {
                return false;
            }
        }

        return true;
    }
}
