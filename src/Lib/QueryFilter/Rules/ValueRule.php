<?php

namespace App\Lib\QueryFilter\Rules;
use App\Lib\QueryFilter\Rule;

class ValueRule extends Rule
{

    public $field;
    public $operator;
    public $value;

    public function __construct(string $field, string $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function get()
    {
        return ["{$this->field} {$this->operator}", $this->value];
    }

    public function canInclude($data)
    {
        return !empty($this->value);
    }

    public function setValue($data)
    {
        /* Do nothing */
    }
}
