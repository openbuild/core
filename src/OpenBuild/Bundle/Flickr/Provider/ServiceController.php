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

		$controllers = $this->mapControllers($app, array(
			'flickr-index.html' => true,
			'flickr-detail.html' => true
		));

		$controllers->get('/index.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'flickr/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file flickr/index.js");
				
			}
			
		});

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['bundle.flickr.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page flickr index';
 		});
 
 		$app['bundle.flickr.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/flickr/index.html';
			$appFile = $app['spa_files_dir'] . 'flickr/index.html';
			
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
				
				$app->abort(404, "Could not find view file flickr/index.html");
				
			}
			
		});  

		$app['bundle.flickr.full_page.detail'] = $app->protect(function() use ($app){
 			return 'Do full page flickr detail';
 		});
 
 		$app['bundle.flickr.detail'] = $app->protect(function() use ($app){

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
				
				$app->abort(404, "Could not find view file filickr/detail.html");
				
			}
			
		});   

    }

	//Service interface
    public function boot(Application $app)
    {

    }

}