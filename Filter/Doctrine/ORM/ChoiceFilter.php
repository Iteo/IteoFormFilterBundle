<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class ChoiceFilter extends Filter
{
    const TYPE_CONTAINS = 'contains';
    const TYPE_NOT_CONTAINS = 'not_contains';
    const TYPE_EQUAL = 'equal';

    public function filter(QueryInterface $query, $field, $data)
    {
        if (!$this->isActive($data)) {
            return;
        }

        $data['type'] = !isset($data['type']) ? self::TYPE_CONTAINS : $data['type'];

        $parameterName = $this->getNewParameterName($query, $field);

        if ($data['type'] == self::TYPE_NOT_CONTAINS) {
            $this->applyWhere($query, sprintf('(%s <> :%s OR %s IS NULL)', $field, $parameterName, $field));
        } else {
            $this->applyWhere($query, sprintf('%s = :%s', $field, $parameterName));
        }

        $query->setParameter($parameterName, $data['value']);
    }

    public function isActive($data)
    {
        if (!$data || !is_array($data) || !array_key_exists('value', $data)) {
            return false;
        }

        if ($data['value'] === '' || $data['value'] === null || $data['value'] === false) {
            return false;
        }

        return true;
    }
}
