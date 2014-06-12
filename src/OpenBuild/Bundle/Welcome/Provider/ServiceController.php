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

		$controllers = $this->mapControllers($app, array(
			'welcome-index.html' => true,
			'welcome-index.js' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['bundle.welcome.full_page.index'] = $app->protect(function() use ($app){
		
			$quote = new \OpenBuild\Bundle\Welcome\Entity\Quote\Repository\InMemory();

			$feature = new \OpenBuild\Bundle\Welcome\Entity\Feature\Repository\InMemory();

			$introduction = new \OpenBuild\Bundle\Welcome\Entity\Introduction\Repository\InMemory();

			$description = new \OpenBuild\Bundle\Welcome\Entity\Description\Repository\InMemory();
		
			return $app->render('app/welcome/index.full.html', [
				'introduction' => $introduction->getLatest(),
				'description' => $description->getLatest(),
				'quotes' => $quote->findAll(),
				'features' => $feature->findAll(),
			]);
		
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
    	
    }

}