<?php

namespace OpenBuild\Bundle\Services\Entity\Introduction;

use OpenBuild\Bundle\Services\Entity\Introduction\Entity;

use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Introduction\Attribute\Body;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $introduction);

    public function remove(Entity $introduction);
}