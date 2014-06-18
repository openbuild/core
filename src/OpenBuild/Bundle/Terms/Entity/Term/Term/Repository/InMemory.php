<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Terms\Entity\Term\Term\Repository;

use OpenBuild\Bundle\Terms\Entity\Term\Term\Repository;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Entity;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Id;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Title;
use OpenBuild\Bundle\Terms\Entity\Term\Term\Attribute\Term;

class InMemory implements Repository
{
    private $messages;

    public function __construct()
    {

        $this->terms[] = new Entity(
        	new Id(1),
        	new Title('Cookies'),
        	new Term('Your are agreeing with our [cookie policy](/terms-cookies.obd).')
        
    	);
    	
    	$this->terms[] = new Entity(
        	new Id(2),
        	new Title('Software'),
        	new Term('THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.')
        );
        
    }

    public function find(Id $id)
    {
    }

    public function findAll()
    {
        return $this->terms;
    }

    public function add(Entity $term)
    {
    }

    public function remove(Entity $term)
    {
    }
    
}