<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute;

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