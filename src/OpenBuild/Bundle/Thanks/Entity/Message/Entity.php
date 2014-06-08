<?php

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