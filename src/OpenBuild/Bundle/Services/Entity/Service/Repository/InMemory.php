<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Services\Entity\Service\Repository;

use OpenBuild\Bundle\Services\Entity\Service\Repository;
use OpenBuild\Bundle\Services\Entity\Service\Entity;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Description;

class InMemory implements Repository
{
    private $products;

    public function __construct()
    {

        $this->services[] = new Entity(
        	new Id(1), 
        	new Title('Web design'),
        	new Description('We can take your requirements and build the solution you need.')
    	);

        $this->services[] = new Entity(
        	new Id(2), 
        	new Title('Hosting'),
        	new Description('If your site needs hosting we can host your current solution or build upon one of our platforms.')
    	);
        
        $this->services[] = new Entity(
        	new Id(3), 
        	new Title('Bespoke software and custom solutions'),
        	new Description('We have over two decades of experience in delivering scalable solutions for SME and Corporate clients.')
    	);
          
        $this->services[] = new Entity(
        	new Id(4), 
        	new Title('Developers for your projects'),
        	new Description('Have you got an in house project but need solid developers to deliver?

Get in [contact](/contact.obd) and see what we can do for you.')
    	);
    	
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->services;
    }

    public function add(Entity $service)
    {
    }

    public function remove(Entity $service)
    {
    }
    
}