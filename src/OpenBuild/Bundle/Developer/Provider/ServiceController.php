<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Developer\Provider;

use OpenBuild\Abstracts\ServiceController AS AbstractServiceController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractServiceController
{

	//Contoller interface
	public function connect(Application $app)
	{
	
		$controllers = $this->mapControllers($app, array(
			'developer-index.html' => true,
			'developer-index.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'developer');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
        
        $app['bundle.developer.full_page.index'] = $app->protect(function() use ($app){
 			return $app->render('@developer/index.full.html', []);
 		});
 
 		$app['bundle.developer.index'] = $app->protect(function() use ($app){

			return $app->render('@developer/index.html', []);

		});
		
		$app['bundle.developer.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
			
			return $app->render('@developer/index.js', [], $response);
		
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {

		
    	
    }

}