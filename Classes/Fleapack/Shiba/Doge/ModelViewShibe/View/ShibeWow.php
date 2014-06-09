<?php
namespace Fleapack\Shiba\Doge\ModelViewShibe\View;

use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\View\JsonView;

class ShibeWow extends JsonView {

	/**
	 * @var NodeWow
	 * @Flow\Inject
	 */
	protected $nodeWow;

	public function render() {
		$propertiesToRender = $this->renderArray();
		//$this->controllerContext->getResponse()->setHeader('Content-Type', 'text/dson');
		return $this->nodeWow->suchExec('so_dogeify', $propertiesToRender);
	}


}