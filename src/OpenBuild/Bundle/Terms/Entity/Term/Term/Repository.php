<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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