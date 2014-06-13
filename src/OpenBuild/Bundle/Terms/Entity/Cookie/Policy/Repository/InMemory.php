<?php

namespace OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Repository;

use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Repository;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Entity;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Attribute\Policy;

class InMemory implements Repository
{
    private $messages;

    public function __construct()
    {

        $this->policies[] = new Entity(
        	new Id(1),
        	new Title('The cookies we set and why'),
        	new Policy('This website is owned and operated by OpenBuild (Sheffield) LTD.

When someone visits our sites we collect standard internet log information and details of visitor behaviour patterns. We do this to find out things such as the number of visitors to the various parts of the site. We collect this information in a way which does not personally identify anyone.

When we do want to collect personally identifiable information - for things like our newsletters - we will be upfront about this. We will make it clear when we collect personal information and will explain what we intend to do with it.

Most web browsers allow some control of most cookies through the browser settings. To find out more about cookies, including how to see what cookies have been set and how to manage and delete them, visit [www.allaboutcookies.org](www.allaboutcookies.org).')
        
    	);
    	
    	$this->policies[] = new Entity(
        	new Id(2),
        	new Title('Cookies from OpenBuild (Sheffield) LTD'),
        	new Policy('Cookies are widely used to make websites work, or work more efficiently, as well as to provide information to the owners of the site and to help deliver adverts correctly.

The details below explain the cookies we use, why we use them and when they are set.')
        );
        
        $this->policies[] = new Entity(
        	new Id(3),
        	new Title('Cookies from our suppliers'),
        	new Policy('We use Google DoubleClick to serve adverts across our sites and have no direct control of the cookies it sets. You can read all about Google\'s advertising cookies [here](http://support.google.com/dfp_premium/bin/answer.py?hl=en&answer=2551880).

You can still receive adverts without being the Google being set. You can opt out [here](http://www.google.com/ads/preferences/plugin/).

Some of our sites use Google Analytics for tracking and reporting of site performance. You can opt out [here](http://tools.google.com/dlpage/gaoptout).

Some of our advertisers use other Ad Servers which may set cookies too. Unfortunately, we can\'t directly control their cookies either. But you can, by taking control of your cookie management. Read how, [here](http://www.allaboutcookies.org/).

Some advertisers try to behaviourally target you using retargeting cookies across sites - that\'s when you notice adverts stalking you across lots of different sites. We forbid this behaviour in the terms and conditions of any advertising contracts we enter into. But you should be aware of how to manage this yourself anyway. [This is a decent resource to help you](http://www.youronlinechoices.com/).')
        );
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->policies;
    }

    public function add(Entity $term)
    {
    }

    public function remove(Entity $term)
    {
    }
    
}