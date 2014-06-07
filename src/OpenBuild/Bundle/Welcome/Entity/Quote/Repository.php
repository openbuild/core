<?php

namespace OpenBuild\Bundle\Welcome\Entity\Quote;

use OpenBuild\Bundle\Welcome\Entity\Quote\Entity;

use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Individual;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Quote;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $quote);

    public function remove(Entity $quote);
}