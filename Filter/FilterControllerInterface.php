<?php

namespace Iteo\Bundle\FormFilterBundle\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

interface FilterControllerInterface
{
    public function filter(QueryInterface $query, $name, $field, $data);

    public function isActive($name, $data);
}
