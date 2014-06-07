<?php

namespace OpenBuild\Bundle\Welcome\Entity\Introduction;

use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Display;

class Entity
{
    private $id;
    private $text;

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