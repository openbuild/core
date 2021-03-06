<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Abstracts;

abstract class Attribute implements \OpenBuild\Interfaces\Attribute{

	protected $value;

	public function __construct($value){
	
		$this->value = $value;

	}

	public function getValue(){
	
		return $this->value;
		
    }

}