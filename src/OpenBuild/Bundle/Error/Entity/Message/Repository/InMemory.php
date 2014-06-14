<?php

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