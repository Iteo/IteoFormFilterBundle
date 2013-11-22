<?php

namespace Iteo\Bundle\FormFilterBundle\Filter;

use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Iteo\Bundle\FormFilterBundle\Filter\Registry\FilterRegistryInterface;

class FilterController implements FilterControllerInterface
{
    /**
     * @var Registry\FilterRegistryInterface
     */
    protected $registry;

    public function __construct(FilterRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function filter(QueryInterface $query, $name, $field, $data)
    {
        $filter = $this->registry->getFilter($name);
        $filter->filter($query, $field, $data);
    }

    public function isActive($name, $data)
    {
        $filter = $this->registry->getFilter($name);

        return $filter->isActive($data);
    }
}
