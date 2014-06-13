<?php

namespace OpenBuild\Bundle\Terms\Entity\Cookie\Introduction;

use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Entity;

use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Attribute\Body;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $introduction);

    public function remove(Entity $introduction);
}