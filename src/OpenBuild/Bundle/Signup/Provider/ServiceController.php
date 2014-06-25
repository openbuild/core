<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\Signup\Provider;

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
			'signup-index.html' => true,
			'signup-index.js' => true
		));

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.signup.full_page.index'] = $app->protect(function() use ($app){

			return $app->render('app/signup/index.full.html', [
			]);

 		});
 
 		$app['bundle.signup.index'] = $app->protect(function() use ($app){

			$localFile = $app['request']->server->get('DOCUMENT_ROOT') . '../views/app/signup/index.html';
			$appFile = $app['spa_files_dir'] . 'signup/index.html';
			
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
				
				$app->abort(404, "Could not find view file signup/index.html");
				
			}

		});
		
		$app['bundle.signup.index.js'] = $app->protect(function() use ($app){
		
			$appFile = $app['spa_files_dir'] . 'signup/index.js';
			
			if(file_exists($appFile)){
					
				return new Response(
            		file_get_contents($appFile),
					200,
					array('content-type' => 'application/javascript')
				);
					
			}else{
				
				$app->abort(404, "Could not find view file signup/index.js");
				
			}
		
		});
		
    }

	//Service interface
    public function boot(Application $app)
    {
    	
    }

}