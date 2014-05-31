<?php

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
	
		// creates a new controller based on the default route
		$controllers = $app['controllers_factory'];

		$controllers->get('/welcome.html', function (Application $app){
				
			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/welcome/welcome.html';
			$appFile = $app['spa_files_dir'] . 'thanks/index.html';
			
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

		$controllers->get('/welcome.js', function (Application $app){
		
			$appFile = $app['spa_files_dir'] . 'welcome/welcome.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file welcome.js");
				
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