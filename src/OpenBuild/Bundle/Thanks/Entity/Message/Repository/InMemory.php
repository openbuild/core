<?php

namespace OpenBuild\Bundle\Thanks\Entity\Message\Repository;

use OpenBuild\Bundle\Thanks\Entity\Message\Repository;
use OpenBuild\Bundle\Thanks\Entity\Message\Entity;
use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Id;
use OpenBuild\Bundle\Thanks\Entity\Message\Attribute\Message;

class InMemory implements Repository
{
    private $messages;

    public function __construct()
    {

        $this->messages[] = new Entity(
        	new Id(1), 
        	new Message('##Photos
        	
###The big footer

We love astronomy and photography, it makes us realise how small we are compared to the vast universe and what we can achieve if we work together.

This photograph was produced by European Southern Observatory (ESO).

Their [website](http://www.eso.org/) [states](http://www.eso.org/public/outreach/copyright/): "All ESO still and motion pictures are released under the Creative Commons Attribution 3.0 Unported, unless the credit byline indicates otherwise."

Babak Tafreshi, one of the ESO Photo Ambassadors, has captured the antennas of the Atacama Large Millimeter/submillimeter Array (ALMA) under the southern sky in another breathtaking image.

The dramatic whorls of stars in the sky are reminiscent of van Gogh’s Starry Night, or — for science fiction fans — perhaps the view from a spacecraft about to enter hyperspace. In reality, though, they show the rotation of the Earth, revealed by the photograph\'s long exposure. In the southern hemisphere, as the Earth turns, the stars appear to move in circles around the south celestial pole, which lies in the dim constellation of Octans (The Octant), between the more famous Southern Cross and the Magellanic Clouds. With a long enough exposure, the stars mark out circular trails as they move.

The photograph was taken on the Chajnantor Plateau, at an altitude of 5000 metres in the Chilean Andes. This is the site of the ALMA telescope, whose antennas can be seen in the foreground. ALMA is the most powerful telescope for observing the cool Universe — molecular gas and dust, as well as the relic radiation of the Big Bang. When ALMA construction is complete in 2013, the telescope will have 54 of these 12-metre-diameter antennas, and twelve 7-metre antennas. However, early scientific observations with a partial array already began in 2011. Even though it is not fully constructed, the telescope is already producing outstanding results, outperforming all other telescopes of its kind. Some of the antennas are blurred in the photograph, as the telescope was in operation and moving during the shot.

ALMA, an international astronomy facility, is a partnership of Europe, North America and East Asia in cooperation with the Republic of Chile. ALMA construction and operations are led on behalf of Europe by ESO, on behalf of North America by the National Radio Astronomy Observatory (NRAO), and on behalf of East Asia by the National Astronomical Observatory of Japan (NAOJ). The Joint ALMA Observatory (JAO) provides the unified leadership and management of the construction, commissioning and operation of ALMA.')
        
    	);
    	
    	$this->messages[] = new Entity(
        	new Id(2), 
        	new Message('Test 2')
        );
        
        $this->messages[] = new Entity(
        	new Id(3), 
        	new Message('Test 3')
        );
        
        $this->messages[] = new Entity(
        	new Id(4), 
        	new Message('Test 4')
        );
        
        $this->messages[] = new Entity(
        	new Id(5), 
        	new Message('Test 5')
        );
        
        $this->messages[] = new Entity(
        	new Id(6), 
        	new Message('Test 6')
        );
        
        $this->messages[] = new Entity(
        	new Id(7), 
        	new Message('Test 7')
        );
        
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->messages;
    }

    public function add(Entity $feature)
    {
    }

    public function remove(Entity $feature)
    {
    }
    
}