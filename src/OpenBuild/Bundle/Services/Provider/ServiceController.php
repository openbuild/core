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
		
		$app['bundle.services.index.js'] = $app->protect(function() use ($app){
		
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
		
    }

	//Service interface
    public function boot(Application $app)
    {

		
    	
    }

}