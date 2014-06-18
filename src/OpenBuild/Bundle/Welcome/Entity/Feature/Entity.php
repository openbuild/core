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

use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Feature;

class Entity
{
    private $id;
    private $feature;

    public function __construct(Id $id, Feature $feature)
    {
        $this->id = $id;
        $this->feature = $feature;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFeature()
    {
        return $this->feature;
    }

}