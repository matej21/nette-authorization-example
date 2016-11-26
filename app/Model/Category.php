<?php declare(strict_types = 1);

namespace App\Model;

use App\Core\Security\IAuthorizationScope;
use App\Core\Security\Identity;
use Nette\SmartObject;

class Category implements IAuthorizationScope
{
	use SmartObject;

	const ROLE_MODERATOR = 'category:moderator';

	private $id;

	private $name;

	/** @var User[] */
	private $moderators = [];


	public function getIdentityRoles(Identity $identity): array
	{
		foreach ($this->moderators as $moderator) {
			if ($moderator->getIdentity() === $identity) {
				return [self::ROLE_MODERATOR];
			}
		}
		return [];
	}

}
