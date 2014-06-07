<?php

namespace OpenBuild\Bundle\Welcome\Entity\Quote\Attribute;

class Quote
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