<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Entity\Description;

use OpenBuild\Bundle\Welcome\Entity\Description\Entity;

use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Display;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $description);

    public function remove(Entity $description);
}