<?php

namespace OpenBuild\Bundle\Welcome\Entity\Feature;

use OpenBuild\Bundle\Welcome\Entity\Feature\Entity;

use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Feature\Attribute\Feature;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $feature);

    public function remove(Entity $feature);
}