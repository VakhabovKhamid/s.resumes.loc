<?php

namespace App\Lib\QueryFilter\Rules;

use App\Lib\QueryFilter\Rule;

class AttributeRule extends Rule
{

    public $field;
    public $operator;
    public $attribute;

    public function __construct(string $field, string $operator, string $attribute)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->attribute = $attribute;
    }

    public function setValue($data)
    {
        $this->value = $data[$this->attribute];
    }

    public function get()
    {
        return ["{$this->field} {$this->operator}", $this->value];
    }

    public function canInclude($data)
    {
        return isset($data[$this->attribute]);
    }
}
