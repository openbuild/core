<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Entity\Quote\Repository;

use OpenBuild\Bundle\Welcome\Entity\Quote\Repository;
use OpenBuild\Bundle\Welcome\Entity\Quote\Entity;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Id;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Individual;
use OpenBuild\Bundle\Welcome\Entity\Quote\Attribute\Quote;

class InMemory implements Repository
{
    private $users;

    public function __construct()
    {

        $this->quotes[] = new Entity(
        	new Id(1), 
        	new Individual(array('name' => 'Adam Land', 'position' => 'Director of Remedies and Business Analysis at the Competition Commission')), 
        	new Quote('This website is a vital component of the package of remedies put in place following our market investigation. Along with other measures, such as data sharing, we expect that our remedy package will open up the market to greater competition, so that customers get more choice and lower prices. I have been impressed by the way in which the home credit industry has worked with other stakeholders to deliver this project.')
        );

        $this->quotes[] = new Entity(
            new Id(2), 
            new Individual(array('name' => 'M Andrews', 'position' => 'St. Joseph\'s School Workington')),
            new Quote('Fantastic app, works well, seems to be intuitive and very useful. It should enable further development in using mobile technology in our school.')
        );

		$this->quotes[] = new Entity(
            new Id(3), 
            new Individual(array('name' => 'Duncan Randall', 'position' => 'Head of client services')),
            new Quote('They are delighted with the site, it exceeds all expectations, uptake is higher than anyone imagined and they would like to thank us all for our helpful and diplomatic approach to the project, which went beyond our obligations.')
        );

		$this->quotes[] = new Entity(
            new Id(4), 
            new Individual(array('name' => 'dweran', 'position' => 'iOS user')),
            new Quote('The most useful of the polling apps I\'ve tried, working better then several more expensive programs in the App Store.')
        );

		$this->quotes[] = new Entity(
            new Id(5), 
            new Individual(array('name' => 'Gareth Thomas', 'position' => 'Consumer Affairs Minister')),
            new Quote('This website will help people to save money and get a good deal. Consumers will be able to shop around for loans from Home Credit providers and local Credit Unions that best meet their needs.')
        );
        
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->quotes;
    }

    public function add(Entity $quote)
    {
    }

    public function remove(Entity $quote)
    {
    }
    
}