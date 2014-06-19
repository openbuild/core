<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Services\Provider;

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
			'services-index.html' => true,
			'services-index.js' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
	
		$app['bundle.services.full_page.index'] = $app->protect(function() use ($app){
		
			return $app->render('app/services/index.full.html', [
				'introduction' => $app['services.repository.introduction']->getLatest(),
				'products' => $app['services.repository.product']->findAll(),
				'services' => $app['services.repository.service']->findAll()
			]);
		
 		});
 
 		$app['bundle.services.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/services/index.html';
			$appFile = $app['spa_files_dir'] . 'services/index.html';
			
			if(file_exists($localFile)){
			
				return new Response(
            		file_get_contents($localFile),
					200
				);
				
			}elseif(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200
				);
					
			}else{
				
				$app->abort(404, "Could not find view file services/index.html");
				
			}

		});
		
		$app['bundle.services.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');

			return $app->render('app/services/index.js', [
				'introduction' => $app['services.repository.introduction']->getLatest(),
				'products' => $app['services.repository.product']->findAll(),
				'services' => $app['services.repository.service']->findAll()
			], $response);
					
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {

		$app['services.repository.introduction'] = $app->share(function(){
			return new \OpenBuild\Bundle\Services\Entity\Introduction\Repository\InMemory();
		});

		$app['services.repository.product'] = $app->share(function(){
			return new \OpenBuild\Bundle\Services\Entity\Product\Repository\InMemory();
		});
    	
    	$app['services.repository.service'] = $app->share(function(){
			return new \OpenBuild\Bundle\Services\Entity\Service\Repository\InMemory();
		});
    	
    }

}