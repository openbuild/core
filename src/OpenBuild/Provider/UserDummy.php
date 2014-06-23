<?php

namespace OpenBuild\Provider;

use OpenBuild\Security\Certificate\Token;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UserDummy implements UserProviderInterface
{

	private $token;

	public function __construct()
	{
	}

	public function loadUserByUsername($email)
	{

		$user = array();
		$roles = array();
			
		if(isset($user['roles'])){
			$roles = $user['roles'];
		}
			
		if(empty($user)){
			
			throw new UsernameNotFoundException();
			
		}

		return new User($user['email'], null, $roles, true, true, true, true);
		
	}

	public function refreshUser(UserInterface $user)
	{

		if (!$user instanceof User) {
			throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
		}

		return $this->loadUserByUsername($user->getUsername());
		
	}

	public function supportsClass($class)
	{
		return $class === 'Symfony\Component\Security\Core\User\User';
	}
	
}