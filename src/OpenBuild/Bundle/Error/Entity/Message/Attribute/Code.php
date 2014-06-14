<?php

namespace OpenBuild\Bundle\Error\Entity\Message\Attribute;

class Code
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
    
}