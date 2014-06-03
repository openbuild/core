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

			if($app['spa'] === true && $app['search_engine'] === false){
				return $app['bundle.welcome.index']();
			}else{
				return $app['bundle.welcome.full_page.index']();
			}
			
		})->bind('welcome-index');

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

		$app['bundle.welcome.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page welcome index';
 		});
 
 		$app['bundle.welcome.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/welcome/welcome.html';
			$appFile = $app['spa_files_dir'] . 'welcome/welcome.html';
			
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