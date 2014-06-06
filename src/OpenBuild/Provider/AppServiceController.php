<?php

namespace OpenBuild\Provider;

use OpenBuild\Abstracts\ServiceController AS AbstractServiceController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppServiceController extends AbstractServiceController
{

	//Contoller interface
	public function connect(Application $app)
	{

		$controllers = $app['controllers_factory'];

		if($app['spa'] && $app['search_engine'] === false){

			$controllers->get('/{name}.{extension}', function(Request $request, $name, $extension) use ($app){
			
				$appFile = $app['spa_files_dir'] . $name . '.' . $extension;

				if(file_exists($appFile)){

					return new Response(
						file_get_contents($appFile),
						200,
						$extension == 'js' ? array('content-type' => 'application/javascript') : array()
					);

				}else{
					$app->abort(404, "Could not find view file app/$name.$extension");
				}
			
			})
			->assert('name', 'main|shell|message-html')
			->assert('extension', 'html|js');

		}

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{

		$app['page.home.full_page'] = $app->protect(function() use ($app){
 			return 'Do full home page';
 		});
 		
		$app['page.home'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/index.html';
			$appFile = $app['spa_files_dir'] . '../index.html';

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
				
				$app->abort(404, "Could not find view file /index.html");
				
			}

		});
		
    }

	//Service interface
    public function boot(Application $app)
    {

    	
    }

}