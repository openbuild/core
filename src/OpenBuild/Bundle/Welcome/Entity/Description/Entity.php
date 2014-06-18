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

use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Display;

class Entity
{
    private $id;
    private $display;

    public function __construct(Id $id, Display $display)
    {
        $this->id = $id;
        $this->display = $display;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDisplay()
    {
        return $this->display;
    }

}