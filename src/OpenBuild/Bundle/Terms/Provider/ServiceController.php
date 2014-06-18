<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Terms\Provider;

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
			'terms-index.html' => true,
			'terms-index.js' => true,
			'terms-cookies.html' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.terms.full_page.index'] = $app->protect(function() use ($app){
 			
			
 			return $app->render('app/terms/index.full.html', [
				'introduction' => $app['terms.repository.introduction']->getLatest(),
				'terms' => $app['terms.repository.term']->findAll(),
			]);
			
 		});
 
 		$app['bundle.terms.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/terms/index.html';
			$appFile = $app['spa_files_dir'] . 'terms/index.html';
			
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
				
				$app->abort(404, "Could not find view file index.html");
				
			}

		});
		
		$app['bundle.terms.index.js'] = $app->protect(function() use ($app){

			$appFile = $app['spa_files_dir'] . 'terms/index.js';
			
			if(file_exists($appFile)){
				
				$response = new Response();
				$response->headers->set('content-type', 'application/javascript');

				return $app->render('app/terms/index.js', [
					'generic-introduction' => $app['terms.repository.introduction']->getLatest(),
					'generic-terms' => $app['terms.repository.term']->findAll(),
					'cookie-introduction' => $app['terms.repository.cookie.introduction']->getLatest(),
					'cookie-policies' => $app['terms.repository.cookie.policy']->findAll()
				], $response);
									
			}else{
				
				$app->abort(404, "Could not find view file index.js");
				
			}

		});
		
		$app['bundle.terms.full_page.cookies'] = $app->protect(function() use ($app){
 			
 			return $app->render('app/terms/cookies.full.html', [
				'introduction' => $app['terms.repository.cookie.introduction']->getLatest(),
				'policies' => $app['terms.repository.cookie.policy']->findAll()
			]);
			
 		});
 
 		$app['bundle.terms.cookies'] = $app->protect(function() use ($app){
 		
 			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/terms/cookies.html';
			$appFile = $app['spa_files_dir'] . 'terms/cookies.html';
			
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
				
				$app->abort(404, "Could not find view file index.html");
				
			}
 		
 		});

    }

	//Service interface
    public function boot(Application $app)
    {

		$app['terms.repository.introduction'] = $app->share(function(){
			return new \OpenBuild\Bundle\Terms\Entity\Term\Introduction\Repository\InMemory();
		});
		
		$app['terms.repository.term'] = $app->share(function(){
			return new \OpenBuild\Bundle\Terms\Entity\Term\Term\Repository\InMemory();
		});

		$app['terms.repository.cookie.introduction'] = $app->share(function(){
			return new \OpenBuild\Bundle\Terms\Entity\Cookie\Introduction\Repository\InMemory();
		});
		
		$app['terms.repository.cookie.policy'] = $app->share(function(){
			return new \OpenBuild\Bundle\Terms\Entity\Cookie\Policy\Repository\InMemory();
		});
			
    }

}