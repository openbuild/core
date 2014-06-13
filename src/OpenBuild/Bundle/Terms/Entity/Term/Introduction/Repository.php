<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Introduction;

use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Entity;

use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Term\Introduction\Attribute\Body;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $introduction);

    public function remove(Entity $introduction);
}