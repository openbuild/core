<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Event\Test\Event;

use Symfony\Component\EventDispatcher\Event AS SymfonyEvent;

class Create extends SymfonyEvent
{

	protected $data;
	protected $date;

	public function __construct($data)
	{
		$this->data = $data;
		$this->date = date('Y-m-d h:i:s');
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function getDate()
	{
		return $this->date;
	}

}