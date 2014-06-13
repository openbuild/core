<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute;

use Parsedown;

class Body
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->parsedown = new Parsedown();

    }

    public function getValue()
    {
        return $this->value;
    }
    
    public function getHTML()
    {
    	return $this->parsedown->text($this->value);
    }
    
}