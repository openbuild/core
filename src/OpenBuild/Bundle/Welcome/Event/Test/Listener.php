<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Event\Test;

use Symfony\Component\Security\Core\User\User;
use Symfony\Component\EventDispatcher\EventDispatcher;

use OpenBuild\Bundle\Welcome\Event\Test\Event\Create;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Read;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Update;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Delete;

class Listener 
{

	private $user;

	public function __construct($user){

		$this->user = $user;

	}

	public function onCreate(Create $event)
	{

		error_log('Do onCreate');
		//error_log(print_r($event, true));
		return array('w00t, w00t');
		
	}

	public function onRead(Read $event)
	{

		error_log('Do onRead');
		//error_log(print_r($event, true));

		//$event->stopPropagation();
		
	}
	
	public function onUpdate(Update $event)
	{

		error_log('Do onUpdate');
		//error_log(print_r($event, true));

		//$event->stopPropagation();

	}
	
	public function onDelete(Delete $event)
	{

		error_log('Do onDelete');
		//error_log(print_r($event, true));

		//$event->stopPropagation();

	}
	
}