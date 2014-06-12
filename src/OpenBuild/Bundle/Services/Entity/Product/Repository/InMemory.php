<?php

namespace OpenBuild\Bundle\Services\Entity\Product\Repository;

use OpenBuild\Bundle\Services\Entity\Product\Repository;
use OpenBuild\Bundle\Services\Entity\Product\Entity;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Description;

class InMemory implements Repository
{
    private $products;

    public function __construct()
    {

        $this->products[] = new Entity(
        	new Id(1), 
        	new Title('openCMS'),
        	new Description('Our content management system allows you to manage your message on the web and optionally on iOS devices if we have created an app for you. You create content on this site ready for review by your team and once you are happy you publish the site and it becomes available for all to view.')
    	);
            
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->products;
    }

    public function add(Entity $product)
    {
    }

    public function remove(Entity $product)
    {
    }
    
}