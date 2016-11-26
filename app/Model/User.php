<?php declare(strict_types = 1);

namespace App\Model;

use App\Core\Security\Identity;
use Nette\SmartObject;

class User
{
	use SmartObject;

	/** @var Identity */
	private $identity;


	public function getIdentity(): Identity
	{
		return $this->identity;
	}

}
