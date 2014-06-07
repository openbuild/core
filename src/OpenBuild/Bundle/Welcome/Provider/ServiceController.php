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

error_log('connect welcome');	
		$controllers = $this->mapControllers($app, array(
			'welcome-index.html' => true,
			'welcome-index.js' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
error_log('register welcome');	

		$app['bundle.welcome.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page welcome index';
 		});
 
 		$app['bundle.welcome.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/welcome/index.html';
			$appFile = $app['spa_files_dir'] . 'welcome/index.html';
			
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
				
				$app->abort(404, "Could not find view file welcome/index.html");
				
			}

		});
		
		$app['bundle.welcome.index.js'] = $app->protect(function() use ($app){
		
			$appFile = $app['spa_files_dir'] . 'welcome/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file welcome/index.js");
				
			}
		
		});

    }

	//Service interface
    public function boot(Application $app)
    {
error_log('boot welcome');	

		
    	
    }

}