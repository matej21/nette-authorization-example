<?php declare(strict_types = 1);

namespace App\Core\Security;

use App\Model\Article;
use App\Model\Category;
use App\Model\Comment;
use Nette\Security\Permission;
use Nette\SmartObject;


class PermissionFactory
{
	use SmartObject;


	public function create(): Permission
	{
		$permission = new Permission();

		$permission->addResource(Article::class);
		$permission->addResource(Comment::class);
		$permission->addResource(Category::class);

		$permission->addRole(Comment::ROLE_AUTHOR);
		$permission->addRole(Article::ROLE_AUTHOR, [Comment::ROLE_AUTHOR]);
		$permission->addRole(Category::ROLE_MODERATOR, [Article::ROLE_AUTHOR]);

		//jen zkratka, abych mohl využít "action", což je pár resource-privilege
		$this->allow($permission, Comment::ROLE_AUTHOR, Comment::ACTION_EDIT);

		$this->allow($permission, Category::ROLE_MODERATOR, Comment::ACTION_DELETE);

		//admin může vše
		$permission->allow(Identity::ROLE_ADMIN, $permission::ALL, $permission::ALL);

		return $permission;
	}


	private function allow(Permission $permission, string $role, array $action)
	{
		list($resource, $privilege) = $action;
		$permission->allow($role, $resource, $privilege);
	}

}
