<?php

namespace OpenBuild\Security\Certificate;
	
use OpenBuild\Security\Certificate\Token;
	
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
	
/*
* See: http://symfony.com/doc/current/cookbook/security/custom_authentication_provider.html
*/
class Listener{
	
	private $securityContext;
	private $authenticationManager;
	
	public function __construct(SecurityContext $securityContext, AuthenticationProviderManager $authenticationManager){
		
		$this->securityContext = $securityContext;
		$this->authenticationManager = $authenticationManager;
		
	}
		
	public function handle(GetResponseEvent $event){
		
		$request = $event->getRequest();
		$email = null;

		$token = new Token();
		$token->setUser($email);

		try{
			
			$authToken = $this->authenticationManager->authenticate($token);
			$this->securityContext->setToken($authToken);

			return;
				
		}catch(AuthenticationException $failed){

			// ... you might log something here

			// To deny the authentication clear the token. This will redirect to the login page.
			// Make sure to only clear your token, not those of other authentication listeners.
			$token = $this->securityContext->getToken();
			if($token instanceof Token && $this->providerKey === $token->getProviderKey()) {
				$this->securityContext->setToken(null);
			}

			return;

		}

		// By default deny authorization
		$response = new Response();
		$response->setStatusCode(Response::HTTP_FORBIDDEN);
		$event->setResponse($response);

		return $response;

	}
	
}