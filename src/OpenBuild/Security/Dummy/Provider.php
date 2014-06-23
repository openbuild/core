<?php

namespace OpenBuild\Security\Dummy;
	
use OpenBuild\Security\Dummy\Token;
	
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
	
/*
* See: http://symfony.com/doc/current/cookbook/security/custom_authentication_provider.html
*/
class Provider{
	
	private $userProvider;
	private $cacheDir;
	
	public function __construct(UserProviderInterface $userProvider, $cacheDir){
		
		$this->userProvider = $userProvider;
		$this->cacheDir = $cacheDir;
		
	}
		
	public function authenticate(Token $token)
	{
			
		$user = $this->userProvider->loadUserByUsername($token->getUsername());

		if(! empty($user)){
				
			$authenticatedToken = new Token($user->getRoles());
			$authenticatedToken->setUser($user);

			return $authenticatedToken;
				
		}

		throw new AuthenticationException('Authentication failed.');

	}
		
	public function supports(Token $token)
	{
		return $token instanceof Token;
	}
	
}