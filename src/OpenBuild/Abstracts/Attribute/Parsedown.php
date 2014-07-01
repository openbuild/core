<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Abstracts\Attribute;

use Parsedown AS Pd;

abstract class Parsedown extends \OpenBuild\Abstracts\Attribute{

	private $parsedown;

	public function __construct($value){
	
		$this->parsedown = new Pd();
		parent::__construct($value);
	}

    public function getHTML(){
    	return $this->parsedown->text($this->value);
    }

}