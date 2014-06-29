<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Signup\Thanks\Entity\Certificate;

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

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest(Email $email);

    public function add(Entity $certificate);

    public function remove(Entity $certificate);
}