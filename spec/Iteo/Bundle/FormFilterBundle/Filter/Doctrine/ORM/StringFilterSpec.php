<?php

namespace spec\Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM;

use Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\StringFilter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringFilterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\StringFilter');
    }

    public function it_should_be_doctrine_orm_filter()
    {
        $this->shouldHaveType('Iteo\Bundle\FormFilterBundle\Filter\Doctrine\ORM\Filter');
    }

    public function it_should_be_filter()
    {
        $this->shouldImplement('Iteo\Bundle\FormFilterBundle\Filter\FilterInterface');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_do_nothing_when_passed_data_has_no_value($query)
    {
        $query->andWhere(Argument::any())->shouldNotBeCalled();

        $this->filter($query, 'field', null);
        $this->filter($query, 'field', false);
        $this->filter($query, 'field', 'string');
        $this->filter($query, 'field', array());
    }

    public function it_is_not_active_when_passed_data_has_no_value()
    {
        $this->isActive(null)->shouldReturn(false);
        $this->isActive(false)->shouldReturn(false);
        $this->isActive('string')->shouldReturn(false);
        $this->isActive(array())->shouldReturn(false);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_do_nothing_when_passed_data_has_empty_value($query)
    {
        $query->andWhere(Argument::any())->shouldNotBeCalled();

        $this->filter($query, 'field', array('value' => null));
        $this->filter($query, 'field', array('value' => false));
        $this->filter($query, 'field', array('value' => ''));
    }

    public function it_is_not_active_when_passed_data_has_empty_value()
    {
        $this->isActive(array('value' => null))->shouldReturn(false);
        $this->isActive(array('value' => false))->shouldReturn(false);
        $this->isActive(array('value' => ''))->shouldReturn(false);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_create_proper_like_condition_by_default($query)
    {
        $value = 'string';
        $data = array('value' => $value);
        $query->getUniqueParameterId()->willReturn(1);
        $query->setParameter('o_field_1', '%' . $value . '%')->shouldBeCalled();
        $query->andWhere('o.field LIKE :o_field_1')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_create_proper_condition_for_equal_operator($query)
    {
        $value = 'string';
        $data = array('value' => $value, 'type' => StringFilter::TYPE_EQUAL);
        $query->getUniqueParameterId()->willReturn(1);
        $query->setParameter('o_field_1', $value)->shouldBeCalled();
        $query->andWhere('o.field = :o_field_1')->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_create_proper_condition_for_contains_operator($query)
    {
        $this->test($query, 'string', StringFilter::TYPE_CONTAINS, 'LIKE');
    }

    /**
     * @param \Iteo\Bundle\FormFilterBundle\Filter\Query\QueryInterface $query
     */
    public function it_should_create_proper_condition_for_not_contains_operator($query)
    {
        $this->test($query, 'string', StringFilter::TYPE_NOT_CONTAINS, 'NOT LIKE');
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
        $query->setParameter('o_field_1', '%' . $value . '%')->shouldBeCalled();
        $query->andWhere(sprintf('o.field %s :o_field_1', $operator))->shouldBeCalled();

        $this->isActive($data)->shouldReturn(true);
        $this->filter($query, 'o.field', $data);
    }
}
