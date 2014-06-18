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

use OpenBuild\Bundle\Error\Entity\Message\Attribute\Code;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Title;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Description;

class Entity
{
    private $code;
    private $title;
    private $description;

    public function __construct(Code $code, Title $title, Description $description)
    {
        $this->code = $code;
        $this->title = $title;
        $this->description = $description;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
}