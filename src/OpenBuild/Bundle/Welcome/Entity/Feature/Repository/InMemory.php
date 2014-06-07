<?php

namespace OpenBuild\Bundle\Welcome\Entity\Feature\Repository;

use OpenBuild\Bundle\Welcome\Entity\Feature\Repository;
use OpenBuild\Bundle\Welcome\Entity\Feature\Entity;
use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Feature;

class InMemory implements Repository
{
    private $features;

    public function __construct()
    {

        $this->features[] = new Entity(
        	new Id(1), 
        	new Feature('Clean MV* Architecture')
        );

        $this->features[] = new Entity(
            new Id(2), 
            new Feature('JS & HTML Modularity')
        );

		$this->features[] = new Entity(
            new Id(3), 
            new Feature('Simple App Lifecycle')
        );

		$this->features[] = new Entity(
            new Id(4), 
            new Feature('Eventing, Modals, Message Boxes, etc.')
        );

		$this->features[] = new Entity(
            new Id(5), 
            new Feature('Navigation & Screen State Management')
        );
        
        $this->features[] = new Entity(
            new Id(6), 
            new Feature('Consistent Async Programming w/ Promises')
        );
        
        $this->features[] = new Entity(
            new Id(7), 
            new Feature('App Bundling and Optimization')
        );
        
        $this->features[] = new Entity(
            new Id(8), 
            new Feature('Use any Backend Technology')
        );
        
        $this->features[] = new Entity(
            new Id(9), 
            new Feature('Built on top of jQuery, Knockout & RequireJS')
        );
        
        $this->features[] = new Entity(
            new Id(10), 
            new Feature('Integrates with other libraries such as SammyJS & Bootstrap')
        );
        
        $this->features[] = new Entity(
            new Id(11), 
            new Feature('Make jQuery & Bootstrap widgets templatable and bindable (or build your own widgets).')
        );
        
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->features;
    }

    public function add(Entity $feature)
    {
    }

    public function remove(Entity $feature)
    {
    }
    
}