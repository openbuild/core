<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Signup\Entity\Certificate\Repository;

use OpenBuild\Bundle\Signup\Entity\Certificate\Repository;
use OpenBuild\Bundle\Signup\Entity\Certificate\Entity;

use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Id;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\FirstName;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\LastName;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Email;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Password;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\PasswordRepeat;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\City;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\County;
use OpenBuild\Bundle\Signup\Entity\Certificate\Attribute\Country;

class InMemory implements Repository
{
    private $certificates;

    public function __construct()
    {

    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->certificates;
    }

	public function getLatest(){
		return $this->certificates[count($this->certificates) - 1];
	}

    public function add(Entity $certificate)
    {
    }

    public function remove(Entity $certificate)
    {
    }
    
}