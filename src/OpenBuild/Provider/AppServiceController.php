<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Provider;

use OpenBuild\Abstracts\ServiceController AS AbstractServiceController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;


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

			//TODO - Configure the home page to any module
			$uri = $app['url_generator']->generate('welcome-index');

			$subRequest = Request::create($uri, 'GET', array(), $app['request']->cookies->all(), array(), $app['request']->server->all());

			if($app['request']->getSession()){
				$subRequest->setSession($app['request']->getSession());
			}

			$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
			
			return $response;

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