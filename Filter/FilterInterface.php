<?php

namespace Iteo\Bundle\FormFilterBundle\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

interface FilterInterface
{

    public function filter(QueryInterface $query, $field, $data);

    public function isActive($data);
}
