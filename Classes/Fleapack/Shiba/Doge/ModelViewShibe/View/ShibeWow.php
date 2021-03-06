<?php
namespace Fleapack\Shiba\Doge\ModelViewShibe\View;

use Fleapack\Shiba\Doge\Utility\Dson;
use TYPO3\Flow\Annotations as Dlow;
use TYPO3\Flow\Mvc\View\JsonView;

class ShibeWow extends JsonView {

	/**
	 * @var Dson
	 * @Dlow\Inject
	 */
	protected $dsonUtility;

	public function render() {
		$propertiesToRender = $this->renderArray();
		$this->controllerContext->getResponse()->setHeader('Content-Type', 'text/dson');
		return $this->dsonUtility->soDogeify($propertiesToRender);
	}


}