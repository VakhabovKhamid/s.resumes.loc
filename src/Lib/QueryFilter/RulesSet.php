<?php

namespace App\Lib\QueryFilter;

class RulesSet
{
    protected $_conditions = [];
    protected $_data = [];

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function add(Rule $rule)
    {
        if ($rule->canInclude($this->_data)) {
            $rule->setValue($this->_data);
            $this->_conditions[] = $rule;
        }
        return $this;
    }

    public function mergeOperator(string $operator, array $rules)
    {
        return $this->_conditions[] = [$operator, $rules];
    }
    /**
     * Get conditions for cake ORM
     *
     * @return array
     */
    public function get(): array
    {
        $result = [];
        foreach ($this->_conditions as $index => $rule) {
            if (!is_array($rule)) {
                list($key, $value) = $rule->get();
                $result[$key] = $value;
            } else {
                list($operator, $data) = $rule;
                $result = $this->prepareMergeRules($operator, $data, $result);
            }
        }
        return $result;
    }

    private function prepareMergeRules($operator, $rules, $result)
    {
        $result = [$operator => []];
        foreach ($rules as $rule) {
            list($key, $value) = $rule->get();
            $result[$operator][$key] = $value;
        }
        return $result;
    }
}
