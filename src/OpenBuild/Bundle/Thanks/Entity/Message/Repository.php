<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Thanks\Entity\Message;

use OpenBuild\Bundle\Thanks\Entity\Message\Entity;

use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Message;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $message);

    public function remove(Entity $message);
}