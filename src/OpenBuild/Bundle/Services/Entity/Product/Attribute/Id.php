<?php

namespace OpenBuild\Bundle\Services\Entity\Product\Attribute;

class Id
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