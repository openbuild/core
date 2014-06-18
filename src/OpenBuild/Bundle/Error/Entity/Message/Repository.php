<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Error\Entity\Message;

use OpenBuild\Bundle\Error\Entity\Message\Entity;

use OpenBuild\Bundle\Error\Entity\Message\Attribute\Code;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Title;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Description;

interface Repository
{
    public function find(Code $code);

    public function findAll();

    public function add(Entity $error);

    public function remove(Entity $error);
}