<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Registry;

use Iteo\Bundle\FormFilterBundle\Filter\FilterInterface;

interface FilterRegistryInterface
{
    public function getFilters();

    public function registerFilter($name, FilterInterface $filter);

    public function hasFilter($name);

    public function unregisterFilter($name);

    /**
     * @param $name
     * @return FilterInterface
     */
    public function getFilter($name);
}
