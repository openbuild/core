<?php

namespace OpenBuild\Bundle\Developer\Provider;

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
				
			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/developer/index.html';
			$appFile = $app['spa_files_dir'] . 'developer/index.html';
			
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
				
				$app->abort(404, "Could not find view file developer/index.html");
				
			}
			
		});

		$controllers->get('/index.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'developer/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file developer/index.js");
				
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