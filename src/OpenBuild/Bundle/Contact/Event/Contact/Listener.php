<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Contact\Event\Contact;

use Symfony\Component\Security\Core\User\User;
use Symfony\Component\EventDispatcher\EventDispatcher;

use OpenBuild\Bundle\Contact\Event\Contact\Event\Create;

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
	
}