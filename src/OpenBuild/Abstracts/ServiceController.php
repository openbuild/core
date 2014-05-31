<?php

/*
 * This file is part of the OpenBuild framework.
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Abstracts;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Silex\ControllerProviderInterface;

/**
 * Interface for service controllers.
 *
 * @author Danny Lewis <openbuild.sheffield@googlemail.com>
 */
abstract class ServiceController implements ServiceProviderInterface, ControllerProviderInterface
{

	public function __construct(Application $app){
		
		$app->register($this);
			
	}

    /**
     *
     * @param Application $app An Application instance
     *
     * @return Application $app An Application instance
     */  
     /*
    public function __construct(Application $app);
    
    public function connect(Application $app);
    
    public function register(Application $app);
    
    public function boot(Application $app);
    */
}
