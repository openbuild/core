<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Durandal\Provider;

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
			'durandal-index.html' => true,
			'durandal-message-html.html' => true,
			'durandal-shell.html' => true,
			'durandal-main.js' => true,
			'durandal-shell.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'durandal');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.durandal.index'] = $app->protect(function() use ($app){
 			
 			return $app->render('@durandal/index.html', [
 			]);
						
 		});
 		
		$app['bundle.durandal.message-html'] = $app->protect(function() use ($app){
 			
 			return $app->render('@durandal/message-html.html', [
 			]);
						
 		});
 		
 		$app['bundle.durandal.shell'] = $app->protect(function() use ($app){
 			
 			return $app->render('@durandal/shell.html', [
 			]);
						
 		});
 				
		$app['bundle.durandal.main.js'] = $app->protect(function() use ($app){

			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');

			return $app->render('@durandal/main.js', [
			], $response);

		});
		
		$app['bundle.durandal.shell.js'] = $app->protect(function() use ($app){

			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');

			return $app->render('@durandal/shell.js', [
			], $response);

		});
 

    }

	//Service interface
    public function boot(Application $app)
    {
	
    }

}