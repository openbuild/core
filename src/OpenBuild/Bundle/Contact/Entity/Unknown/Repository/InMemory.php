<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Contact\Entity\Unknown\Repository;

use OpenBuild\Bundle\Contact\Entity\Unknown\Repository;
use OpenBuild\Bundle\Contact\Entity\Unknown\Entity;

use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Id;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\FirstName;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\LastName;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Email;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Phone;
use OpenBuild\Bundle\Contact\Entity\Unknown\Attribute\Message;

class InMemory implements Repository
{
    private $messages;

    public function __construct()
    {
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->messages;
    }

	public function getLatest(){
		return $this->messages[count($this->messages) - 1];
	}

    public function add(Entity $message)
    {
    }

    public function remove(Entity $message)
    {
    }
    
}