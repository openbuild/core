<?php

namespace OpenBuild\Bundle\Services\Entity\Introduction\Repository;

use OpenBuild\Bundle\Services\Entity\Introduction\Repository;
use OpenBuild\Bundle\Services\Entity\Introduction\Entity;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Body;

class InMemory implements Repository
{
    private $introductions;

    public function __construct()
    {

        $this->introductions[] = new Entity(
        	new Id(1), 
        	new Title('Products and services.'),
        	new Body('What we do and how we can help you. 
        	
We offer a range of products and services that help you to meet your requirements to grow and support your business, we can make the technology do what you need so you can focus on what matters to you, your business.')
        );

    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->introductions;
    }

	public function getLatest(){
		return $this->introductions[count($this->introductions) - 1];
	}

    public function add(Entity $introduction)
    {
    }

    public function remove(Entity $introduction)
    {
    }
    
}