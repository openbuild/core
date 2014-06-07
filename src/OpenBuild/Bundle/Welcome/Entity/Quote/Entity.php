<?php

namespace OpenBuild\Bundle\Welcome\Entity\Quote;

use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Individual;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Quote;

class Entity
{
    private $id;
    private $individual;
    private $quote;

    public function __construct(Id $id, Individual $individual, Quote $quote)
    {
        $this->id = $id;
        $this->individual = $individual;
        $this->quote = $quote;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIndividual()
    {
        return $this->individual;
    }

    public function getQuote()
    {
        return $this->quote;
    }

}