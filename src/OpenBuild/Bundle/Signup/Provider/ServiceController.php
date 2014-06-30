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
			'signup-index.html' => array('methods' => array('get', 'post')),
			'signup-index.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'signup');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.signup.full_page.index'] = $app->protect(function() use ($app){

			if($app['request']->getMethod() == 'POST'){
//var_dump($app['request']->request->all());
			
			}

			return $app->render('@signup/index.full.html', []);

 		});
 
 		$app['bundle.signup.index'] = $app->protect(function() use ($app){

			return $app->render('@signup/index.html', []);

		});
		
		$app['bundle.signup.index.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
			
			return $app->render('@signup/index.js', [], $response);
		
		});
		
    }

/*
			
			$test = new \OpenBuild\Security\Certificate\Generate();
			
			$test->setDnCountryName('UK');
			$test->setDnStateOrProvinceName('South Yorkshire');
			$test->setDnLocalityName('Sheffield');
			$test->setDnOrganizationName('OpenBuild (Sheffield) LTD');
			$test->setDnOrganizationalUnitName('Development');
			$test->setDnCommonName('Danny Lewis');
			$test->setDnEmailAddress('dannylewis.sheffield@googlemail.com');
	
			$test->setPassword('letmein');
	
			$test->export();
			var_dump($test);
			die();

*/

	//Service interface
    public function boot(Application $app)
    {
    	
    }

}