<?php

namespace OpenBuild\Bundle\Terms\Entity\Cookie\Policy;

use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Policy;

class Entity
{
    private $id;
    private $title;
    private $policy;

    public function __construct(Id $id, Title $title, Policy $policy)
    {
        $this->id = $id;
        $this->title = $title;
        $this->policy = $policy;
    }

    public function getId()
    {
        return $this->id;
    }

	public function getTitle()
    {
        return $this->title;
    }
    
    public function getPolicy()
    {
        return $this->policy;
    }

}