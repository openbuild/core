<?php

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