<?php declare(strict_types = 1);

namespace App\Core\Security;

use Nette\Security\IAuthorizator;
use Nette\SmartObject;


class Authorizator
{
	use SmartObject;

	/** @var IAuthorizator */
	private $authorizator;


	public function __construct(IAuthorizator $authorizator)
	{
		$this->authorizator = $authorizator;
	}


	public function isAllowed(Identity $identity, IAuthorizationScope $scope, array $action): bool
	{
		list($resource, $privilege) = $action;
		foreach ($this->getRoles($identity, $scope) as $role) {
			if ($this->authorizator->isAllowed($role, $resource, $privilege)) {
				return TRUE;
			}
		}

		return FALSE;
	}


	private function getRoles(Identity $identity, IAuthorizationScope $scope)
	{
		//globální role
		foreach ($identity->getRoles() as $role) {
			yield $role; //yield používám, jelikoz když to matchne globální roli, je zbytečné se ptát scope na dynamické role
		}
		foreach ($scope->getIdentityRoles($identity) as $role) {
			yield $role;
		}
	}

}
