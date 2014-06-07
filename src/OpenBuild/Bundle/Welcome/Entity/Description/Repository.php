<?php

namespace OpenBuild\Bundle\Welcome\Entity\Description;

use OpenBuild\Bundle\Welcome\Entity\Description\Entity;

use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Description\Attribute\Display;

interface Repository
{
    public function find(Id $id);

    public function findAll();
    
    public function getLatest();

    public function add(Entity $description);

    public function remove(Entity $description);
}