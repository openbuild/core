<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Contact\Provider;

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
			'contact-index.html' => true,
			'contact-index.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'contact');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
		$app['bundle.contact.full_page.index'] = $app->protect(function() use ($app){
 			return $app->render('@contact/index.full.html', []);
 		});
 
 		$app['bundle.contact.index'] = $app->protect(function() use ($app){

			return $app->render('@contact/index.html', []);

		});
		
		$app['bundle.contact.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
		
			return $app->render('@contact/index.js', [], $response);
		
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {
    	
    }

}