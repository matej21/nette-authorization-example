<?php declare(strict_types = 1);

namespace App\Model;

use App\Core\Security\IAuthorizationScope;
use App\Core\Security\Identity;
use Nette\SmartObject;

class Comment implements IAuthorizationScope
{
	use SmartObject;

	const ROLE_AUTHOR = 'comment:author';

	//akce jsou jen dvojice resource-privilege
	const ACTION_EDIT = [self::class, 'edit'];
	const ACTION_DELETE = [self::class, 'delete'];


	private $id;

	/** @var Article */
	private $article;

	private $content;

	/** @var User */
	private $author;


	public function getIdentityRoles(Identity $identity): array
	{
		$roles = [];
		if ($this->author->getIdentity() === $identity) {
			$roles[] = self::ROLE_AUTHOR;
		}

		return array_merge($roles, $this->article->getIdentityRoles($identity));
	}

}
