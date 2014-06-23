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
			$app['search_engine'] = false;
			
			$app['spa_files_dir'] = dirname(__FILE__) . '/views/app/';
			
			$app->register(new \Silex\Provider\TwigServiceProvider(), array(
				'twig.path' => __DIR__.'/views',
			));
			
			$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

			$app['security.user_provider.dummy'] = $app->share(function() use ($app){
				return new \Openbuild\Provider\UserDummy();
			});
			
			$app['security.firewalls'] = array(
				//Login is not protected
				'login' => array(
					'pattern' => '^/login.obd$',
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
				$this->mount('/terms',     new \OpenBuild\Bundle\Terms\Provider\ServiceController($app));
				$this->mount('/thanks',    new \OpenBuild\Bundle\Thanks\Provider\ServiceController($app));
				$this->mount('/welcome',   new \OpenBuild\Bundle\Welcome\Provider\ServiceController($app));
			
			}else{
			
				$this->mount('/app/contact',   new \OpenBuild\Bundle\Contact\Provider\ServiceController($app));
				$this->mount('/app/developer', new \OpenBuild\Bundle\Developer\Provider\ServiceController($app));
				$this->mount('/app/error',     new \OpenBuild\Bundle\Error\Provider\ServiceController($app));
				$this->mount('/app/flickr',    new \OpenBuild\Bundle\Flickr\Provider\ServiceController($app));
				$this->mount('/app/services',  new \OpenBuild\Bundle\Services\Provider\ServiceController($app));
				$this->mount('/app/terms',     new \OpenBuild\Bundle\Terms\Provider\ServiceController($app));
				$this->mount('/app/thanks',    new \OpenBuild\Bundle\Thanks\Provider\ServiceController($app));
				$this->mount('/app/welcome',   new \OpenBuild\Bundle\Welcome\Provider\ServiceController($app));
			
			}
						
			$this->get('/{home}', function(Request $request) use ($app){

				if($app['spa'] && $app['search_engine'] === false){
					return $app['page.home']();
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
				'/terms.obd' => 'terms-index',
				'/terms-cookies.obd' => 'terms-cookies',
				'/thanks.obd' => 'thanks-index'
			);
	
			$this->get('/{page}.obd', function(Request $request) use ($app){
			
				if($request->query->get('_escaped_fragment_') !== null){

					if(isset($app['spaSearchEngineMap'][$request->getPathInfo()])){
					
						$uri = $app['url_generator']->generate($app['spaSearchEngineMap'][$request->getPathInfo()]);
						$subRequest = Request::create($uri, 'GET');
						$response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
						return $response->getContent();
					
					}else{
					
						$app->abort(404, "Could not find view for " . $request->getPathInfo());
					
					}
				
				}

				$subRequest = Request::create('/', 'GET');
				return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);

			});

/*			
			$this->get('/{path}', function(\Symfony\Component\HttpFoundation\Request $request, $path) use ($app){

				if(
					! is_null($request->query->get('_escaped_fragment_'))
					||
					$request->getRequestUri() == '/?_escaped_fragment_='
				){
					return "Do html fragment for $path";
				}

				$fullPath = $app['bootDirectory'] . '/' . $app['serve'] . '/App/index.html';
			
				if(file_exists($fullPath)){
					return file_get_contents($fullPath);
				}
				
				$fullPath = $app['bootDirectory'] . '/__default/App/index.html';
			
				if(file_exists($fullPath)){
					return file_get_contents($fullPath);
				}
				
				$app->abort(404, "Could not file file /app/$path.$extension .");
			
			})
			->value('path', 'index.obd')
			->assert('path', '(.*).obd')
			->convert('path', function($path){
				return substr($path, 0, -4);
			});

			$this->get('/app/{path}.{extension}', function(\Symfony\Component\HttpFoundation\Request $request, $path, $extension) use ($app){

				$fullPath = $app['bootDirectory'] . '/' . $app['serve'] . '/App/' . $path . '.' . $extension;
//die($fullPath);		
				if(file_exists($fullPath)){
					return file_get_contents($fullPath);
				}
				
				$fullPath = $app['bootDirectory'] . '/__default/App/' . $path . '.' . $extension;
		
				if(file_exists($fullPath)){
					return file_get_contents($fullPath);
				}
				
				$app->abort(404, "Could not file file /app/$path.$extension .");
		
			})
			->assert('path', '[\w\d-_\/]+')
			//->assert('path', '.*')
			->assert('extension', '(js|html)');
			
			$this->post('/test1', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){
								
				$result = array(
					'error' => false,
					'uri' => 'growl',
					'payload' => array(
						'message' => 'w00t test 1',
						'data' => $request->request->get('fu')
					),
					'request' => $request,
				);
				
				return $app->json($result);
				
			});

			$this->post('/test2', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){

				$result = array(
					'error' => false,
					'uri' => 'growl',
					'payload' => array(
						'message' => 'w00t test 2',
						'data' => $request->request->get('fu')
					),
					'request' => $request,
				);
				
				return $app->json($result);
				
			});
			
			$this->post('/test3', function(\Symfony\Component\HttpFoundation\Request $request) use ($app){

				$result = array(
					'error' => false,
					'uri' => 'growl',
					'payload' => array(
						'message' => 'w00t test 3',
						'data' => $request->request->get('fu')
					),
					'request' => $request,
				);
				
				return $app->json($result);
				
			});
*/			
		}

		static function getInstance(){

			$class = get_called_class();
			$app = new $class();
			$app->configure();
						
			return $app;

		}

	}
