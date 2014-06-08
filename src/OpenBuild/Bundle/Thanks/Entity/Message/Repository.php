<?php

namespace OpenBuild\Bundle\Thanks\Entity\Message;

use OpenBuild\Bundle\Thanks\Entity\Message\Entity;

use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Message;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $message);

    public function remove(Entity $message);
}