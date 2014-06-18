<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Repository;

use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Repository;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Entity;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Body;

class InMemory implements Repository
{
    private $introductions;

    public function __construct()
    {

        $this->introductions[] = new Entity(
        	new Id(1), 
        	new Title('Cookie Policy'),
        	new Body('The cookies we set and why.')
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