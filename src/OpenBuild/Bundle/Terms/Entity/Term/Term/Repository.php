<?php

namespace OpenBuild\Bundle\Terms\Entity\Term\Term;

use OpenBuild\Bundle\Terms\Entity\Term\Term\Entity;

use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Term;

interface Repository
{
    public function find(Id $id);

    public function findAll();

    public function add(Entity $term);

    public function remove(Entity $term);
}