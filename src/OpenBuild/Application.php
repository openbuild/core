<?php

	/*
		Copyright (c) 2014 Danny Lewis, OpenBuild (Sheffield) LTD

		This program is dual licensed, for a commercial license (MIT) please contact us 
		for non-commercial license the GPL3 applies.

		/// For commerical use you must buy a license from OpenBuild (Sheffield) LTD ///
		
		The MIT License (MIT)

		Permission is hereby granted, free of charge, to any person obtaining a copy
		of this software and associated documentation files (the "Software"), to deal
		in the Software without restriction, including without limitation the rights
		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
		copies of the Software, and to permit persons to whom the Software is
		furnished to do so, subject to the following conditions:

		The above copyright notice and this permission notice shall be included in
		all copies or substantial portions of the Software.

		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.

		See http://opensource.org/licenses/MIT for further details

		/// For non-commerical use the terms of the GPL3 license apply ///
		
		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
		
		See http://www.gnu.org/licenses/gpl.html and http://www.gnu.org/licenses/gpl-3.0.txt
		
		/// General terms that apply to all licenses ///
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
		
		The above copyright notice and this permission notice shall be included in
		all copies or substantial portions of the Software.
	
	*/

	namespace OpenBuild;
	
	use Silex\Application AS SilexApplication;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\HttpKernelInterface;
	use Silex\Provider\FormServiceProvider;
	use Silex\Provider\SecurityServiceProvider;

	use Symfony\Component\Translation\Loader\YamlFileLoader;

	class Application extends SilexApplication{

		use \Silex\Application\TwigTrait;
		use \Silex\Application\SecurityTrait;
		use \Silex\Application\FormTrait;
		use \Silex\Application\UrlGeneratorTrait;
		use \Silex\Application\SwiftmailerTrait;
		use \Silex\Application\MonologTrait;
		use \Silex\Application\TranslationTrait;
				
		public function configure(){
		
			$app = $this;

			$app['debug'] = true;
			$app['spa'] = true;
			$app['spa_handler'] = 'durandal';
			$app['search_engine'] = false;
			
			//$app['spa_files_dir'] = dirname(__FILE__) . '/views/app/';
			
			$app->register(new \Silex\Provider\TwigServiceProvider(), array(
				//'twig.path' => __DIR__.'/views',
				'twig.options' => array(
					'cache'     => __DIR__.'/Cache',
					'strict_variables' => true,
					'debug' => true,
					'autoescape' => true
				)
			));
			
			$app['twig.loader.filesystem']->addPath(__DIR__.'/Layout', 'layout');
			
			$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

			$app['security.user_provider.dummy'] = $app->share(function() use ($app){
				return new \OpenBuild\Provider\UserDummy();
			});
			
			$app['security.firewalls'] = array(
				//Login is not protected
				'login' => array(
					'pattern' => '^/login.obd$',
					'security' => false,
				),
				'signup' => array(
					'pattern' => '^/user-signup.obd$',
					'security' => false,
				),
				//Everything else is protected
				'all' => array(
					'pattern' => '^.*$',
					'stateless' => true,
					'security' => true,
					'dummy' => true,
				),
			);
			
			$app->register(new \Silex\Provider\SecurityServiceProvider());
			
			$app['security.authentication_listener.factory.dummy'] = $app->protect(function ($name, $options) use ($app){

				// define the authentication provider object
				$app['security.authentication_provider.'.$name.'.dummy'] = $app->share(function () use ($app){
					return new \OpenBuild\Security\Dummy\Provider($app['security.user_provider.dummy'], __DIR__.'/security_cache');
				});

				// define the authentication listener object
				$app['security.authentication_listener.'.$name.'.dummy'] = $app->share(function () use ($app){
					return new \OpenBuild\Security\Dummy\Listener($app['security'], $app['security.authentication_manager']);
				});

				return array(
					// the authentication provider id
					'security.authentication_provider.'.$name.'.dummy',
					// the authentication listener id
					'security.authentication_listener.'.$name.'.dummy',
					// the entry point id
					null,
					// the position of the listener in the stack
					'pre_auth'
				);
				
			});

			$app->before(function(Request $request) use ($app){
			
				if($app['spa'] === false || $request->query->get('_escaped_fragment_') !== null){

					$app['search_engine'] = true;
				
				}

			}, Application::EARLY_EVENT);

			$this->before(function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
				
				if(0 === strpos($request->headers->get('Content-Type'), 'application/json')){
									
					$data = json_decode($request->getContent(), true);
					$request->request->replace(is_array($data) ? $data : array());
					
				}

				return $request;

			});
			
			$this->after(function (Request $request, Response $response){
			});
			
			$this->mount('/app',   new \OpenBuild\Provider\AppServiceController($app));
			
			//TODO - Workout dynamic routes			
			if(isset($_GET['_escaped_fragment_']) || $app['spa'] === false){

				$this->mount('/contact',   new \OpenBuild\Bundle\Contact\Provider\ServiceController($app));
				$this->mount('/flickr',    new \OpenBuild\Bundle\Flickr\Provider\ServiceController($app));
				$this->mount('/services',  new \OpenBuild\Bundle\Services\Provider\ServiceController($app));
				$this->mount('/user',      new \OpenBuild\Bundle\User\Provider\ServiceController($app));
				$this->mount('/terms',     new \OpenBuild\Bundle\Terms\Provider\ServiceController($app));
				$this->mount('/thanks',    new \OpenBuild\Bundle\Thanks\Provider\ServiceController($app));
				$this->mount('/welcome',   new \OpenBuild\Bundle\Welcome\Provider\ServiceController($app));
			
			}else{

				//TODO FIXME - use $app['spa_handler']
				$this->mount('/app/durandal',   new \OpenBuild\Bundle\Durandal\Provider\ServiceController($app));
			
				$this->mount('/app/contact',   new \OpenBuild\Bundle\Contact\Provider\ServiceController($app));
				$this->mount('/app/developer', new \OpenBuild\Bundle\Developer\Provider\ServiceController($app));
				$this->mount('/app/error',     new \OpenBuild\Bundle\Error\Provider\ServiceController($app));
				$this->mount('/app/flickr',    new \OpenBuild\Bundle\Flickr\Provider\ServiceController($app));
				$this->mount('/app/services',  new \OpenBuild\Bundle\Services\Provider\ServiceController($app));
				$this->mount('/app/user',      new \OpenBuild\Bundle\User\Provider\ServiceController($app));
				$this->mount('/app/terms',     new \OpenBuild\Bundle\Terms\Provider\ServiceController($app));
				$this->mount('/app/thanks',    new \OpenBuild\Bundle\Thanks\Provider\ServiceController($app));
				$this->mount('/app/welcome',   new \OpenBuild\Bundle\Welcome\Provider\ServiceController($app));
			
			}
						
			$this->get('/{home}', function(Request $request) use ($app){

				if($app['spa'] && $app['search_engine'] === false){
					return $app['page.home.spa']();
				}else{
					return $app['page.home.full_page']();
				}
				
			})
			->assert('home', '|index.html|index.obd')
			->bind('homepage');
			
			$app['spaSearchEngineMap'] = array(
				'/index.obd' => 'welcome-index',
				'/contact-us.obd' => 'contact-index',
				'/flickr.obd' => 'flickr-index',
				'/products-and-services.obd' => 'services-index',
				'/user-signup.obd' => 'user-signup',
				'/terms.obd' => 'terms-index',
				'/terms-cookies.obd' => 'terms-cookies',
				'/thanks.obd' => 'thanks-index'
			);
	
			$this->match('/{page}.obd', function(Request $request) use ($app){

				if($request->query->get('_escaped_fragment_') !== null){

					if(isset($app['spaSearchEngineMap'][$request->getPathInfo()])){

						$subRequest = Request::create(
							$app['url_generator']->generate($app['spaSearchEngineMap'][$request->getPathInfo()]), 
							$request->getMethod(),
							$request->request->all(),
							$request->cookies->all(),
							$request->files->all(),
							$request->server->all(),
							$request->getContent()
						);

						$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);

						return $response->getContent();
					
					}else{
					
						$app->abort(404, "Could not find view for " . $request->getPathInfo());
					
					}
				
				}

				$subRequest = Request::create('/', 'GET');
				return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);

			});
	
		}

		static function getInstance(){

			$class = get_called_class();
			$app = new $class();
			$app->configure();
						
			return $app;

		}

	}
