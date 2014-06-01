<?php

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
	
		// creates a new controller based on the default route
		$controllers = $app['controllers_factory'];

		$controllers->get('/detail.html', function (Application $app){
				
			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/flickr/detail.html';
			$appFile = $app['spa_files_dir'] . 'flickr/detail.html';
			
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
				
				$app->abort(404, "Could not find view file detail.html");
				
			}
			
		});

		$controllers->get('/flickr.html', function (Application $app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/flickr/flickr.html';
			$appFile = $app['spa_files_dir'] . 'flickr/flickr.html';
			
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
				
				$app->abort(404, "Could not find view file flickr.html");
				
			}
			
		});

		$controllers->get('/flickr.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'flickr/flickr.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file flickr.js");
				
			}
			
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

		
    	
    }

}