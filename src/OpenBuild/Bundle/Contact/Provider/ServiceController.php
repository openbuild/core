<?php

namespace OpenBuild\Bundle\Contact\Provider;

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
			'contact-index.html' => true,
			'contact-index.js' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
		$app['bundle.contact.full_page.index'] = $app->protect(function() use ($app){
 			return 'Do full page contact index';
 		});
 
 		$app['bundle.contact.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/contact/index.html';
			$appFile = $app['spa_files_dir'] . 'contact/index.html';
			
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
				
				$app->abort(404, "Could not find view file contact/index.html");
				
			}

		});
		
		$app['bundle.contact.index.js'] = $app->protect(function() use ($app){
		
			$appFile = $app['spa_files_dir'] . 'contact/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file contact/index.js");
				
			}
		
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {
    	
    }

}