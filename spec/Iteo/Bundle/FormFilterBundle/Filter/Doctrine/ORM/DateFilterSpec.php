<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\DateFilter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateFilterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\DateFilter');
    }

    function it_should_be_doctrine_orm_filter()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\Filter');
    }

    function it_should_be_filter()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\FilterInterface');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_do_nothing_when_passed_data_has_no_value($query)
    {
        $query->andWhere(Argument::any())->shouldNotBeCalled();

        $this->filter($query, 'field', null);
        $this->filter($query, 'field', false);
        $this->filter($query, 'field', 'string');
        $this->filter($query, 'field', array());
    }

    function it_is_not_active_when_passed_data_has_no_value()
    {
        $this->isActive(null)->shouldReturn(false);
        $this->isActive(false)->shouldReturn(false);
        $this->isActive('string')->shouldReturn(false);
        $this->isActive(array())->shouldReturn(false);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_do_nothing_when_passed_data_has_empty_value($query)
    {
        $query->andWhere(Argument::any())->shouldNotBeCalled();

        $this->filter($query, 'field', array('value' => null));
        $this->filter($query, 'field', array('value' => false));
        $this->filter($query, 'field', array('value' => ''));
    }

    function it_is_not_active_when_passed_data_has_empty_value()
    {
        $this->isActive(array('value' => null))->shouldReturn(false);
        $this->isActive(array('value' => false))->shouldReturn(false);
        $this->isActive(array('value' => ''))->shouldReturn(false);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_equal_condition_by_default($query)
    {
        $value = new \DateTime();
        $data = array('value' => $value);
        $query->getUniqueParameterId()->will(new \Prophecy\Promise\ReturnPromise(array(1,2)));
        $query->setParameter('o_field_1', Argument::type('\DateTime'))->shouldBeCalled();
        $query->setParameter('o_field_2', Argument::type('\DateTime'))->shouldBeCalled();
        $query->andWhere('o.field >= :o_field_1')->shouldBeCalled();
        $query->andWhere('o.field <= :o_field_2')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_null_operator($query)
    {
        $data = array('value' => '', 'type' => DateFilter::TYPE_NULL);
        $query->andWhere('o.field IS NULL')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_not_null_operator($query)
    {
        $data = array('value' => '', 'type' => DateFilter::TYPE_NOT_NULL);
        $query->andWhere('o.field IS NOT NULL')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_equal_operator($query)
    {
        $value = new \DateTime();
        $data = array('value' => $value, 'type' => DateFilter::TYPE_EQUAL);
        $query->getUniqueParameterId()->will(new \Prophecy\Promise\ReturnPromise(array(1,2)));
        $query->setParameter('o_field_1', Argument::type('\DateTime'))->shouldBeCalled();
        $query->setParameter('o_field_2', Argument::type('\DateTime'))->shouldBeCalled();
        $query->andWhere('o.field >= :o_field_1')->shouldBeCalled();
        $query->andWhere('o.field <= :o_field_2')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_less_then_operator($query)
    {
        $this->test($query, new \DateTime(), DateFilter::TYPE_LESS_THAN, '<');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_less_equal_operator($query)
    {
        $this->test($query, new \DateTime(), DateFilter::TYPE_LESS_EQUAL, '<=');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_greater_then_operator($query)
    {
        $this->test($query, new \DateTime(), DateFilter::TYPE_GREATER_THAN, '>');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    function it_should_create_proper_condition_for_greater_equal_operator($query)
    {
        $this->test($query, new \DateTime(), DateFilter::TYPE_GREATER_EQUAL, '>=');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     * @param $value
     * @param $operatorType
     * @param $operator
     */
    protected function test($query, $value, $operatorType, $operator)
    {
        $data = array('value' => $value, 'type' => $operatorType);
        $query->getUniqueParameterId()->willReturn(1);
        $query->setParameter('o_field_1', $value)->shouldBeCalled();
        $query->andWhere(sprintf('o.field %s :o_field_1', $operator))->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }
}
