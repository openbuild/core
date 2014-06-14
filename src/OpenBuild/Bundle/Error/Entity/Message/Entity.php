<?php

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