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
		$json = parent::render();
		return $this->nodeWow->suchExec('so_dogeify', json_decode($json, TRUE));
	}


}