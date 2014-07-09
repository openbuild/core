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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use OpenBuild\Bundle\Contact\Event\Contact\Name;

use OpenBuild\Bundle\Welcome\Event\Test\Event\Create;

class Subscriber implements EventSubscriberInterface
{

	private $listener;

	public function __construct($app){
	
		$this->app = $app;
	
	}

	private function getListener(){
	
		if(! empty($this->listener)){
		
			return $this->listener;
		
		}

/*
		if($this->app['security']){
			$token = $this->app['security']->getToken();
		}else{
			$token = null;
		}
		
		if(null !== $token){
			$user = $token->getUser();
		}else{
			$user = null;
		}

		$this->listener = new Listener($user);
*/

		$this->listener = new Listener(null);
		
		return $this->listener;
		
	}

    public static function getSubscribedEvents()
    {
    	
        return array(
        	Name::create => array('onCreate', 0)
        );
        
    }

    public function onCreate(Event\Create $event)
    {
		return $this->getListener()->onCreate($event);
    }
    
}