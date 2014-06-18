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

use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Message;

class Entity
{
    private $id;
    private $message;

    public function __construct(Id $id, Message $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

}