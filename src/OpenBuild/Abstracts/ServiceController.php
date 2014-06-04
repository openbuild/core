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

	protected function mapControllers($app, $map){
	
		$controllers = $app['controllers_factory'];

		foreach($map AS $key => $fullPage){
		
			$split = preg_split('/(\.|-)/', $key);	
		
			$module = $split[0];
			$page = $split[1];
			$extension = $split[2];
			
			$bind = $module . '-' . $page;
			$uri  = '/'. $page . '.' . $extension;
			$spa  = 'bundle.' . $module . '.' . $page;
			$full = 'bundle.' . $module .'.full_page.' . $page;

/*
			var_dump($bind);
			var_dump($uri);
			var_dump($spa);
			var_dump($full);
			var_dump($fullPage);
*/
			$func = function(Application $app) use ($spa, $full, $fullPage){
			
				if($app['spa'] === true && $app['search_engine'] === false){
					return $app[$spa]();
				}else{
					return $app[$full]();
				}
			
			};
			
			$controllers->get($uri, $func)->bind($bind);
		
		}

		return $controllers;
	
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
