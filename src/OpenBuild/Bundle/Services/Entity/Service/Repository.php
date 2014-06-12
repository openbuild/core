<?php

namespace OpenBuild\Bundle\Services\Entity\Service;

use OpenBuild\Bundle\Services\Entity\Service\Entity;

use OpenBuild\Bundle\Services\Entity\Service\Attribute\Id;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Title;
use OpenBuild\Bundle\Services\Entity\Service\Attribute\Description;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $service);

    public function remove(Entity $service);
}