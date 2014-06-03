<?php

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
	
		// creates a new controller based on the default route
		$controllers = $app['controllers_factory'];

		$controllers->get('/index.html', function (Application $app){

			if($app['spa'] === true && $app['search_engine'] === false){
				return $app['bundle.terms.index']();
			}else{
				return $app['bundle.terms.full_page.index']();
			}
			
		})->bind('terms-index');

		$controllers->get('/cookies.html', function (Application $app){
			
			if($app['spa'] === true && $app['search_engine'] === false){
				return $app['bundle.terms.cookies']();
			}else{
				return $app['bundle.terms.full_page.cookies']();
			}
						
		});

		$controllers->get('/index.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'terms/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file index.js");
				
			}
			
		});

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.terms.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page terms index';
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
		
		$app['bundle.terms.full_page.cookies'] = $app->protect(function() use ($app){
 			return 'Do full page terms cookies';
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

		
    	
    }

}