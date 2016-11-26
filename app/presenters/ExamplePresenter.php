<?php

namespace App\Presenters;

use App\Core\Security\Authorizator;
use App\Core\Security\IAuthorizationScope;
use App\Model\Category;
use App\Model\Comment;
use App\Model\User;
use Nette;


class ExamplePresenterPresenter extends Nette\Application\UI\Presenter
{

	/** @var Authorizator @inject */
	public $authorizator;


	public function actionEditComment($id)
	{
		$comment = $this->loadComment($id);
		$this->requireAccess($comment, $comment::ACTION_EDIT);
		//...
	}


	public function handleDeleteComment($id)
	{
		$comment = $this->loadComment($id);
		$this->requireAccess($comment, $comment::ACTION_EDIT);
	}


	public function actionEditCommentsInCategory($categoryId)
	{
		$category = $this->loadCategory($categoryId);

		/*
		 * Nemusíme předávat tu nejkonkrétnější scope
		 * tenhle případ matchne pouze moderatora (a admina), jelikoz v tehle scope nemůže dojít k přiřazení rolí autora komentáře ani autora článku
		 */
		$this->requireAccess($category, Comment::ACTION_EDIT);
	}


	protected function requireAccess(IAuthorizationScope $scope, array $action)
	{
		if (!$this->isAllowed($scope, $action)) {
			throw new Nette\Application\ForbiddenRequestException();
		}
	}


	protected function isAllowed(IAuthorizationScope $scope, array $action)
	{
		return $this->authorizator->isAllowed($this->getLoggedInUser()->getIdentity(), $scope, $action);
	}


	protected function getLoggedInUser(): User
	{
		//todo
	}

	protected function loadComment($id): Comment
	{
		//todo
	}

	protected function loadCategory($id): Category
	{
		//todo
	}
}
