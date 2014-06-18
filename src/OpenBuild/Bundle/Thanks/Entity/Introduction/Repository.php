<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Thanks\Entity\Introduction;

use OpenBuild\Bundle\Thanks\Entity\Introduction\Entity;

use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Title;
use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Body;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $introduction);

    public function remove(Entity $introduction);
}