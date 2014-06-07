<?php

namespace OpenBuild\Bundle\Welcome\Entity\Introduction;

use OpenBuild\Bundle\Welcome\Entity\Introduction\Entity;

use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Introduction\Attribute\Display;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $introduction);

    public function remove(Entity $introduction);
}