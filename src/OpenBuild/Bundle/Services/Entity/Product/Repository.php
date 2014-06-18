<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Services\Entity\Product;

use OpenBuild\Bundle\Services\Entity\Product\Entity;

use OpenBuild\Bundle\Services\Entity\Product\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Description;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $product);

    public function remove(Entity $product);
}