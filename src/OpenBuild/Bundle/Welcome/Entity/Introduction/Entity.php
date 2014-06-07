<?php

namespace OpenBuild\Bundle\Welcome\Entity\Introduction;

use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Text;

class Entity
{
    private $id;
    private $text;

    public function __construct(Id $id, Text $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

}