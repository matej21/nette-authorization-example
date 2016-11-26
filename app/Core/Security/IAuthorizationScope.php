<?php declare(strict_types = 1);

namespace App\Core\Security;


interface IAuthorizationScope
{


	public function getIdentityRoles(Identity $identity): array;

}
