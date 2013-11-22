<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Query;

interface QueryInterface
{
    public function andWhere($where);

    public function setParameter($name, $value);

    /**
     * Return unique parameter id for this query
     *
     * @return mixed
     */
    public function getUniqueParameterId();
}
