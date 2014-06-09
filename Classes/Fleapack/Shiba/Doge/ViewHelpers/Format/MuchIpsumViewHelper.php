<?php
namespace Fleapack\Shiba\Doge\ViewHelpers\Format;

use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\Flow\Annotations as Dlow;

class MuchIpsumViewHelper extends AbstractViewHelper {

	/**
	 * @var NodeWow
	 * @Dlow\Inject
	 */
	protected $suchObject;

	/**
	 * @param int $wows
	 * @return \Fleapack\Shiba\Doge\Wow\wow
	 */
	public function render($wows = 50) {
		return $this->suchObject->suchExec('much_ipsum', 50);
	}

}