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
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiceController extends AbstractServiceController
{

	//Contoller interface
	public function connect(Application $app)
	{

		$controllers = $this->mapControllers($app, array(
			'contact-index.html' => array('methods' => array('get', 'post')),
			'contact-index.js' => true,
			'contact-contact.js' => array('methods' => array('get', 'post'))
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'contact');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
		$app['bundle.contact.full_page.index'] = $app->protect(function() use ($app){
		
			if($app['request']->getMethod() == 'POST'){
var_dump($app['request']->request->all());
die();

				$app->on(KernelEvents::TERMINATE, function() use ($path){
				});

			
			}

 			return $app->render('@contact/index.full.html', []);

 		});
 
 		$app['bundle.contact.index'] = $app->protect(function() use ($app){

			return $app->render('@contact/index.html', []);

		});
		
		$app['bundle.contact.index.js'] = $app->protect(function() use ($app){

			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
		
			return $app->render('@contact/index.js', [
				'dir' => dirname($app['request']->getRequestURI())
			], $response);
		
		});

		$app['bundle.contact.contact.js'] = $app->protect(function() use ($app){
		
			$data = $app['request']->request->all();
			$data['server_response'] = 'TODO';
		
			return new JsonResponse($data);
			
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {

		$app['contact.repository.unknown'] = $app->share(function(){
			return new \OpenBuild\Bundle\Contact\Entity\Unknown\Repository\InMemory();
		});

    }

}