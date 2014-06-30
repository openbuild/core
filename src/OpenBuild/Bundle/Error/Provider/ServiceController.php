<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Error\Provider;

use OpenBuild\Abstracts\ServiceController AS AbstractServiceController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractServiceController
{

	//Contoller interface
	public function connect(Application $app)
	{
	
		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'error');
	
		// creates a new controller based on the default route
		$controllers = $app['controllers_factory'];

		$controllers->get('/not-found.html', function (Application $app){
				
			return $app->render('@error/not-found.html', []);
			
		});

		$controllers->get('/not-found.js', function (Application $app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
			
			return $app->render('@error/not-found.js', [], $response);
			
		});

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
        
    }

	//Service interface
    public function boot(Application $app)
    {

		$app['error.repository.message'] = $app->share(function(){
			return new \OpenBuild\Bundle\Error\Entity\Message\Repository\InMemory();
		});
    	
    }

}