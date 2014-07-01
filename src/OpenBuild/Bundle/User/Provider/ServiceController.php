<?php

/*
 * This file is part of the OpenBuild framework https://github.com/openbuild/core
 *
 * (c) Danny Lewis <openbuild.sheffield@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenBuild\Bundle\User\Provider;

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
			'user-signup.html' => array('methods' => array('get', 'post')),
			'user-signup.js' => true
		));

		$app['twig.loader.filesystem']->addPath(__DIR__.'/../View', 'user');

		return $controllers;

	}

	//Service interface
	public function register(Application $app)
	{
 
 		$app['bundle.user.full_page.signup'] = $app->protect(function() use ($app){

			if($app['request']->getMethod() == 'POST'){
//var_dump($app['request']->request->all());
			
			}

			return $app->render('@user/signup.full.html', []);

 		});
 
 		$app['bundle.user.signup'] = $app->protect(function() use ($app){

			return $app->render('@user/signup.html', []);

		});
		
		$app['bundle.user.signup.js'] = $app->protect(function() use ($app){
		
			$response = new Response();
			$response->headers->set('content-type', 'application/javascript');
			
			return $app->render('@user/signup.js', [], $response);
		
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