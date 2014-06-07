<?php

namespace OpenBuild\Bundle\Thanks\Provider;

use OpenBuild\Abstracts\ServiceController AS AbstractServiceController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractServiceController
{

	//Contoller interface
	public function connect(Application $app)
	{
error_log('connect thanks');	
	
		$controllers = $this->mapControllers($app, array(
			'thanks-index.html' => true,
			'thanks-index.js' => true
		));
	
		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
error_log('register thanks');	

		$app['bundle.thanks.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page thanks index';
 		});
 
 		$app['bundle.thanks.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/thanks/index.html';
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
		
		$app['bundle.thanks.index.js'] = $app->protect(function() use ($app){
		
			$appFile = $app['spa_files_dir'] . 'thanks/index.js';
			
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
error_log('boot thanks');	

		
    	
    }

}