<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class StringFilter extends Filter
{
    const TYPE_CONTAINS = 'contains';
    const TYPE_NOT_CONTAINS = 'not_contains';
    const TYPE_EQUAL = 'equal';

    public function filter(QueryInterface $query, $field, $data)
    {
        if (!$this->isActive($data)) {
            return;
        }

        $data['value'] = trim($data['value']);

        $data['type'] = !isset($data['type']) ? self::TYPE_CONTAINS : $data['type'];

        $operator = $this->getOperator($data['type']);

        if (!$operator) {
            $operator = 'LIKE';
        }

        $parameterName = $this->getNewParameterName($query, $field);
        $this->applyWhere($query, sprintf('%s %s :%s', $field, $operator, $parameterName));

        if ($data['type'] == self::TYPE_EQUAL) {
            $query->setParameter($parameterName, $data['value']);
        } else {
            $query->setParameter($parameterName, sprintf('%%%s%%', $data['value']));
        }
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    private function getOperator($type)
    {
        $choices = array(
            self::TYPE_CONTAINS => 'LIKE',
            self::TYPE_NOT_CONTAINS => 'NOT LIKE',
            self::TYPE_EQUAL => '=',
        );

        return isset($choices[$type]) ? $choices[$type] : false;
    }

    public function isActive($data)
    {
        if (!$data || !is_array($data) || !array_key_exists('value', $data)) {
            return false;
        }

        if (strlen(trim($data['value'])) == 0) {
            return false;
        }

        return true;
    }
}
