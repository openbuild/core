<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Entity\Description\Repository;

use OpenBuild\Bundle\Welcome\Entity\Description\Repository;
use OpenBuild\Bundle\Welcome\Entity\Description\Entity;
use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Display;

class InMemory implements Repository
{
    private $introductions;

    public function __construct()
    {

        $this->descriptions[] = new Entity(
        	new Id(1), 
        	new Display('We are passionate technologist with a love of open source software and an agile approach to development and can help you deliver the solutions you need in a timely fashion. We specialise in open web technologies including Linux, Apache, Nginx, MySQL, Mongo, PHP, Node.JS on the server and well written Javascript on the client including Durandal, Knockout & jQuery.  We can also deliver iOS apps.')
        );

    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->descriptions;
    }

	public function getLatest(){
		return $this->descriptions[count($this->descriptions) - 1];
	}

    public function add(Entity $description)
    {
    }

    public function remove(Entity $description)
    {
    }
    
}