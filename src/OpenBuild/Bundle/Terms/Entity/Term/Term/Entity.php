<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Term;

use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Term;

class Entity
{
    private $id;
    private $title;
    private $term;

    public function __construct(Id $id, Title $title, Term $term)
    {
        $this->id = $id;
        $this->title = $title;
        $this->term = $term;
    }

    public function getId()
    {
        return $this->id;
    }

	public function getTitle()
    {
        return $this->title;
    }
    
    public function getTerm()
    {
        return $this->term;
    }

}