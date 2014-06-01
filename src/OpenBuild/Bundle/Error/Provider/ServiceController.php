<?php

namespace OpenBuild\Bundle\Error\Provider;

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

		$controllers->get('/not-found.html', function (Application $app){
				
			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/error/not-found.html';
			$appFile = $app['spa_files_dir'] . 'error/not-found.html';
			
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
				
				$app->abort(404, "Could not find view file error/not-found.html");
				
			}
			
		});

		$controllers->get('/not-found.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'error/not-found.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file error/not-found.js");
				
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