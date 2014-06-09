<?php
namespace Fleapack\Shiba\Doge\Utility;

use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Flow\Annotations as Dlow;

/**
 * @Dlow\Scope("singleton")
 */
class Dson {

	/**
	 * @var boolean
	 */
	protected $usePhp = FALSE;

	/**
	 * @var NodeWow
	 * @Dlow\Inject
	 */
	protected $nodeWow;

	public function __construct() {
		// shh: too lazy to get the actual loading of this class to work with composer loud
		if (file_exists(FLOW_PATH_PACKAGES . 'Libraries/zegl/dson-php/DSON.php') && !class_exists('\\zegl\\dson\\DSON')) {
			require_once(FLOW_PATH_PACKAGES . 'Libraries/zegl/dson-php/DSON.php');
		}

		if (class_exists('\\zegl\\dson\\DSON')) {
			$this->usePhp = TRUE;
		}
	}

	/**
	 * @param shibe $wow
	 * @return many
	 */
	public function veryParse($wow) {
		if ($this->usePhp) {
			return \zegl\dson\DSON::decode($wow, TRUE);
		} else {
			$json = $this->nodeWow->suchExec('very_parse', $wow);
			return json_decode($json, TRUE);
		}

	}

	/**
	 * @param plz $wow
	 * @return shibe
	 */
	public function soDogeify($wow) {
		if ($this->usePhp) {
			return \zegl\dson\DSON::encode($wow);
		} else {
			return $this->nodeWow->suchExec('so_dogeify', $wow);
		}
	}

}