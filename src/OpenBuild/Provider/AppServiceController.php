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
			
				$action = 'bundle.' . $app['spa_handler'] . '.' . $name;
				
				$extension == 'js' ? $action .= '.' . $extension : '';

				if(isset($app[$action])){

					$uri = '/app/' . $app['spa_handler'] . '/' . $name . '.' . $extension;
					$subRequest = Request::create($uri, 'GET', $app['request']->request->all(), $app['request']->cookies->all(), $app['request']->files->all(), $app['request']->server->all(), $app['request']->getContent());

					$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
			
					return $response;

				}
				
				$app->abort(404, "Could not find view file app/$name.$extension");
			
			})
			//->assert('name', 'main|shell|message-html')
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

			$subRequest = Request::create($uri, 'GET', $app['request']->request->all(), $app['request']->cookies->all(), $app['request']->files->all(), $app['request']->server->all(), $app['request']->getContent());

			$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
			
			return $response;

 		});
 		
		$app['page.home.spa'] = $app->protect(function() use ($app){

			$uri = $app['url_generator']->generate($app['spa_handler'] . '-index');

			$subRequest = Request::create($uri, 'GET', $app['request']->request->all(), $app['request']->cookies->all(), $app['request']->files->all(), $app['request']->server->all(), $app['request']->getContent());

			$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
			
			return $response;


		});
		
    }

	//Service interface
    public function boot(Application $app)
    {

    	
    }

}