<?php

namespace OpenBuild\Bundle\Error\Entity\Message;

use OpenBuild\Bundle\Error\Entity\Message\Entity;

use OpenBuild\Bundle\Error\Entity\Message\Attribute\Code;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Title;
use OpenBuild\Bundle\Error\Entity\Message\Attribute\Description;

interface Repository
{
    public function find(Code $code);

    public function findAll();

    public function add(Entity $error);

    public function remove(Entity $error);
}