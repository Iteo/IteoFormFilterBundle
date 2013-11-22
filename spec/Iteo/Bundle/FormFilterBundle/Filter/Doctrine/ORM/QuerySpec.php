<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuerySpec extends ObjectBehavior
{
    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    function let($queryBuilder)
    {
        $this->beConstructedWith($queryBuilder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\Query');
    }

    function it_should_be_query()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface');
    }

    function it_should_initialize_unique_parameter_id_by_default()
    {
        $this->getUniqueParameterId()->shouldReturn(0);
    }

    function it_should_generate_unique_parameter_id_proper()
    {
        $this->getUniqueParameterId()->shouldReturn(0);
        $this->getUniqueParameterId()->shouldReturn(1);
        $this->getUniqueParameterId()->shouldReturn(2);
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    function it_should_add_where_condition_proper($queryBuilder)
    {
        $queryBuilder->andWhere('field = :parameter')->shouldBeCalled();
        $this->andWhere('field = :parameter');
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    function it_should_set_parameter_proper($queryBuilder)
    {
        $queryBuilder->setParameter('parameter', 'value')->shouldBeCalled();
        $this->setParameter('parameter', 'value');
    }
}
