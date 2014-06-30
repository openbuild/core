<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Thanks\Provider;

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
			'thanks-index.html' => true,
			'thanks-index.js' => true
		));
	
		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'thanks');
	
		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['bundle.thanks.full_page.index'] = $app->protect(function() use ($app){

			return $app->render('@thanks/index.html', [
				'introduction' => $app['thanks.repository.introduction']->getLatest(),
				'messages' => $app['thanks.repository.message']->findAll()			
			]);

 		});
 
 		$app['bundle.thanks.index'] = $app->protect(function() use ($app){

			return $app->render('@thanks/index.html', []);

		});
		
		$app['bundle.thanks.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');

			return $app->render('@thanks/index.js', [
				'introduction' => $app['thanks.repository.introduction']->getLatest(),
				'messages' => $app['thanks.repository.message']->findAll()			
			], $response);

		});
	   
    }

	//Service interface
    public function boot(Application $app)
    {
		
		$app['thanks.repository.introduction'] = $app->share(function(){
			return new \OpenBuild\Bundle\Thanks\Entity\Introduction\Repository\InMemory();
		});
		
		$app['thanks.repository.message'] = $app->share(function(){
			return new \OpenBuild\Bundle\Thanks\Entity\Message\Repository\InMemory();
		});
    
    }

}