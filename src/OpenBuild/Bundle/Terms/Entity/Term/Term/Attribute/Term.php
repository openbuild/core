<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute;

use Parsedown;

class Term
{
    private $value;
    private $parsedown;

    public function __construct($value)
    {
        $this->value = $value;
        $this->parsedown = new Parsedown();
    }

    public function getValue()
    {
        return $this->value;
    }
    
    public function getHTML(){
    	return $this->parsedown->text($this->value);
    }
    
}