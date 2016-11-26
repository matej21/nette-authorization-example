<?php declare(strict_types = 1);

namespace App\Model;

use App\Core\Security\IAuthorizationScope;
use App\Core\Security\Identity;
use Nette\SmartObject;

class Article implements IAuthorizationScope
{
	use SmartObject;

	const ROLE_AUTHOR = 'article:author';

	private $id;

	private $name;

	private $content;

	/** @var Category */
	private $category;

	/** @var User */
	private $author;


	public function getIdentityRoles(Identity $identity): array
	{
		$roles = [];
		if ($this->author->getIdentity() === $identity) {
			$roles[] = self::ROLE_AUTHOR;
		}

		return array_merge($roles, $this->category->getIdentityRoles($identity));
	}

}
