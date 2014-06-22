<?php

namespace OpenBuild\Bundle\Welcome\Event\Test;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use OpenBuild\Bundle\Welcome\Event\Test\Name;

use OpenBuild\Bundle\Welcome\Event\Test\Event\Create;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Read;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Update;
use OpenBuild\Bundle\Welcome\Event\Test\Event\Delete;

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
        	Name::create => array('onCreate', 0),
        	Name::read   => array('onRead', 0),
        	Name::update => array('onUpdate', 0),
        	Name::delete => array('onDelete', 0),
        );
        
    }

    public function onCreate(Event\Create $event)
    {
		return $this->getListener()->onCreate($event);
    }

    public function onRead(Event\Read $event)
    {
		return $this->getListener()->onRead($event);
    }

    public function onUpdate(Event\Update $event)
    {
		return $this->getListener()->onUpdate($event);
    }

    public function onDelete(Event\Delete $event)
    {
		return $this->getListener()->onDelete($event);
    }
    
}