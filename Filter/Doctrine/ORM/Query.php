<?php

namespace Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class Query implements QueryInterface
{
    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @param mixed $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder      = $queryBuilder;
        $this->uniqueParameterId = 0;
    }

    public function andWhere($where)
    {
        $this->queryBuilder->andWhere($where);
    }

    public function setParameter($name, $value)
    {
        $this->queryBuilder->setParameter($name, $value);
    }

    public function getUniqueParameterId()
    {
        return $this->uniqueParameterId++;
    }
}
