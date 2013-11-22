<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Registry;

use Iteo\Bundle\FormFilterBundle\Filter\FilterInterface;

class FilterRegistry implements FilterRegistryInterface
{
    /**
     * @var array
     */
    protected $filters;

    public function __construct()
    {
        $this->filters = array();
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function registerFilter($name, FilterInterface $filter)
    {
        if ($this->hasFilter($name)) {
            throw new ExistingFilterException($name);
        }
        $this->filters[$name] = $filter;
    }

    public function hasFilter($name)
    {
        return isset($this->filters[$name]);
    }

    public function unregisterFilter($name)
    {
        if (!$this->hasFilter($name)) {
            throw new NonExistingFilterException($name);
        }

        unset($this->filters[$name]);
    }

    public function getFilter($name)
    {
        if (!$this->hasFilter($name)) {
            throw new NonExistingFilterException($name);
        }

        return $this->filters[$name];
    }
}
