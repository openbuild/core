<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute;

class Title
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