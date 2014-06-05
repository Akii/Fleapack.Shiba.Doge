<?php
namespace Fleapack\Shiba\Doge\ViewHelpers\Format;

use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\Flow\Annotations as Dlow;

class MuchIpsumViewHelper extends AbstractViewHelper {

	const WOW_SCRIPT_MUCH_AWESOME = 'Application/Fleapack.Shiba.Doge/Resources/Wow/ManyScript/much_ipsum.js';

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
		$soCommand = FLOW_PATH_PACKAGES . self::WOW_SCRIPT_MUCH_AWESOME . ' ' . $wows;
		return $this->suchObject->suchExec($soCommand);
	}

}