<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Error\Entity\Message\Repository;

use OpenBuild\Bundle\Error\Entity\Message\Repository;
use OpenBuild\Bundle\Error\Entity\Message\Entity;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Code;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Title;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Description;

class InMemory implements Repository
{
    private $messages;

    public function __construct()
    {
    	
    	$this->messages[] = new Entity(
        	new Code(404),
        	new Title('Page not found on OpenBuild (Sheffield) LTD!'), 
        	new Description('We could not find the page you were looking for.')
        );
        
        $this->messages[] = new Entity(
        	new Code(500),
        	new Title('Internal Server Error'), 
        	new Description('An unexpected condition was encountered.')
        );
        
        $this->messages[] = new Entity(
        	new Code(501),
        	new Title('Not Implemented'), 
        	new Description('The server either does not recognise the request method, or it lacks the ability to fulfill the request.')
        );
        
        $this->messages[] = new Entity(
        	new Code(502),
        	new Title('Bad Gateway'), 
        	new Description('The server acting as a gateway or proxy received an invalid response from the upstream server.')
        );
        
        $this->messages[] = new Entity(
        	new Code(503),
        	new Title('Service Unavailable'), 
        	new Description('The server is currently unavailable (because it is overloaded or down for maintenance). Generally, this is a temporary state, please try again soon.')
        );
        
        $this->messages[] = new Entity(
        	new Code(504),
        	new Title('Gateway Timeout'), 
        	new Description('The server is acting as a gateway or proxy and did not receive a timely response from the upstream server.')
        );
        
        $this->messages[] = new Entity(
        	new Code(505),
        	new Title('HTTP Version Not Supported'), 
        	new Description('The server does not support the HTTP protocol version used in the request.')
        );

    }

    public function find(Code $code)
    {
    }

    public function findAll()
    {
        return $this->messages;
    }

    public function add(Entity $message)
    {
    }

    public function remove(Entity $message)
    {
    }
    
}