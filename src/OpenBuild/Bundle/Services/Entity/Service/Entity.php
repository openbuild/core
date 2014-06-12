<?php

namespace OpenBuild\Bundle\Services\Entity\Service;

use OpenBuild\Bundle\Services\Entity\Service\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Description;

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