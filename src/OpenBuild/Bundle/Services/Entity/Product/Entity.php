<?php

namespace OpenBuild\Bundle\Services\Entity\Product;

use OpenBuild\Bundle\Services\Entity\Product\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Product\Attribute\Description;

class Entity
{
    private $id;
    private $title;
    private $description;

    public function __construct(Id $id, Title $title, Description $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
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