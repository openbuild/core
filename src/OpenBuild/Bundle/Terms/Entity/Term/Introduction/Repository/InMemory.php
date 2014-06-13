<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Introduction\Repository;

use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Repository;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Entity;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Body;

class InMemory implements Repository
{
    private $introductions;

    public function __construct()
    {

        $this->introductions[] = new Entity(
        	new Id(1), 
        	new Title('Terms and Conditions'),
        	new Body('We have tried to keep this as short and readble as possible.')
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