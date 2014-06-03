<?php

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
	
		// creates a new controller based on the default route
		$controllers = $app['controllers_factory'];

		$controllers->get('/index.html', function (Application $app){

			if($app['spa'] === true && $app['search_engine'] === false){
				return $app['bundle.services.index']();
			}else{
				return $app['bundle.services.full_page.index']();
			}
			
		})->bind('services-index');

		$controllers->get('/index.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'services/index.js';
			
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
	
		$app['bundle.services.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page services index';
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
    }

	//Service interface
    public function boot(Application $app)
    {

		
    	
    }

}