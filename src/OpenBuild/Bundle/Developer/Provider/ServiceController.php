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
	
		$controllers = $this->mapControllers($app, array(
			'developer-index.html' => true,
		));

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
        
        $app['bundle.developer.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page contact index';
 		});
 
 		$app['bundle.developer.index'] = $app->protect(function() use ($app){

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
		
    }

	//Service interface
    public function boot(Application $app)
    {

		
    	
    }

}