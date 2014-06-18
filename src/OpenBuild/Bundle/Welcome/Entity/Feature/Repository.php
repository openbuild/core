<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Entity\Feature;

use OpenBuild\Bundle\Welcome\Entity\Feature\Entity;

use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Feature;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $feature);

    public function remove(Entity $feature);
}