<?php declare(strict_types = 1);

namespace App\Core\Security;

use Nette\SmartObject;

/**
 * Jedná se o jinou identitu než z Nette\Security, proto neimplementuje IIdentity
 * Můžeme na ní mít nějaké globální role, jako admin. Tedy ty, které se nevztahují k žádné scope.
 *
 * Identitu může mít například uživatel, ale třeba i API klíč. Tím můžeme řešit autorizaci uživatlů a API úplně stějně.
 */
class Identity
{
	use SmartObject;

	const ROLE_ADMIN = 'admin';

	private $id;

	private $roles = [];


	public function getRoles()
	{
		return $this->roles;
	}

}
