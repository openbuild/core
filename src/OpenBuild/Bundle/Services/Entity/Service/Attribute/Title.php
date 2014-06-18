<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Services\Entity\Service\Attribute;

use Parsedown;

class Title
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