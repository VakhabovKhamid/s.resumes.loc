<?php

namespace App\Lib\QueryFilter;

abstract class Rule
{
    public $field;
    public $operator;
    abstract public function get();
    abstract public function canInclude($data);
}
