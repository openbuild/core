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

use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Title;
use OpenBuild\Bundle\Thanks\Entity\Introduction\Attribute\Body;

class Entity
{
    private $id;
    private $title;
    private $body;

    public function __construct(Id $id, Title $title, Body $body)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

	public function getBody()
    {
        return $this->body;
    }

}