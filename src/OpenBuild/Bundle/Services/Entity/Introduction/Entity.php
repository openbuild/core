<?php

namespace OpenBuild\Bundle\Services\Entity\Introduction;

use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Body;

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