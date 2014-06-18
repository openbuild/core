<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Terms\Entity\Cookie\Policy;

use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Entity;

use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Policy;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $policy);

    public function remove(Entity $policy);
}