<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Flickr\Provider;

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
			'flickr-index.html' => true,
			'flickr-index.js' => true,
			'flickr-detail.html' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'flickr');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['bundle.flickr.full_page.index'] = $app->protect(function() use ($app){
 			return $app->render('@flickr/index.full.html', []);
 		});
 
 		$app['bundle.flickr.index'] = $app->protect(function() use ($app){

			return $app->render('@flickr/index.html', []);
			
		});  

		$app['bundle.flickr.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
		
			return $app->render('@flickr/index.js', [], $response);
		
		});

		$app['bundle.flickr.full_page.detail'] = $app->protect(function() use ($app){
 			return $app->render('@flickr/detail.full.html', []);
 		});
 
 		$app['bundle.flickr.detail'] = $app->protect(function() use ($app){

			return $app->render('@flickr/detail.html', []);
			
		});   

    }

	//Service interface
    public function boot(Application $app)
    {

    }

}