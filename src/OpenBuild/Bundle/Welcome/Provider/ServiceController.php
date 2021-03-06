<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Welcome\Provider;

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
			'welcome-index.html' => true,
			'welcome-index.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'welcome');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['bundle.welcome.full_page.index'] = $app->protect(function() use ($app){
		
			return $app->render('@welcome/index.full.html', [
				'introduction' => $app['welcome.repository.introduction']->getLatest(),
				'description' => $app['welcome.repository.description']->getLatest(),
				'quotes' => $app['welcome.repository.quote']->findAll(),
				'features' => $app['welcome.repository.feature']->findAll()			
			]);
		
 		});
 
 		$app['bundle.welcome.index'] = $app->protect(function() use ($app){

			return $app->render('@welcome/index.html', []);

		});
		
		$app['bundle.welcome.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
			
			return $app->render('@welcome/index.js', [
				'introduction' => $app['welcome.repository.introduction']->getLatest(),
				'description' => $app['welcome.repository.description']->getLatest(),
				'quotes' => $app['welcome.repository.quote']->findAll(),
				'features' => $app['welcome.repository.feature']->findAll()			
			], $response);
					
		});

    }

	//Service interface
    public function boot(Application $app)
    {
    
		$app['dispatcher']->addSubscriber(new \OpenBuild\Bundle\Welcome\Event\Test\Subscriber($app));

		$event = new \OpenBuild\Bundle\Welcome\Event\Test\Event\Create(array('testing...'));
		$response = $app['dispatcher']->dispatch(\OpenBuild\Bundle\Welcome\Event\Test\Name::create, $event);
var_dump($response);
die();

		$app['welcome.repository.introduction'] = $app->share(function(){
			return new \OpenBuild\Bundle\Welcome\Entity\Introduction\Repository\InMemory();
		});

		$app['welcome.repository.description'] = $app->share(function(){
			return new \OpenBuild\Bundle\Welcome\Entity\Description\Repository\InMemory();
		});

    	$app['welcome.repository.quote'] = $app->share(function(){
			return new \OpenBuild\Bundle\Welcome\Entity\Quote\Repository\InMemory();
		});
		
		$app['welcome.repository.feature'] = $app->share(function(){
			return new \OpenBuild\Bundle\Welcome\Entity\Feature\Repository\InMemory();
		});
    
    }

}