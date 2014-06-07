<?php

namespace OpenBuild\Bundle\Welcome\Entity\Introduction\Repository;

use OpenBuild\Bundle\Welcome\Entity\Introduction\Repository;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Entity;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Display;

class InMemory implements Repository
{
    private $introductions;

    public function __construct()
    {

        $this->introductions[] = new Entity(
        	new Id(1), 
        	new Display('Welcome to OpenBuild (Sheffield) LTD!')
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