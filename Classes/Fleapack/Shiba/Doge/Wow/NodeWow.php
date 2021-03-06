<?php
namespace Fleapack\Shiba\Doge\Wow;

use TYPO3\Flow\Annotations as Dlow;

/**
 * @Dlow\Scope("singleton")
 */
class NodeWow {

	/**
	 * @var string
	 */
	const WOW_SCRIPT_MUCH_AWESOME = 'Application/Fleapack.Shiba.Doge/Resources/Wow/ManyScript/';

	/**
	 * @param many $script
	 * @param so $argument
	 * @return wow
	 * @todo no many argument, much disapoint
	 */
	public function suchExec($script, $argument = NULL) {
		$soCommand = FLOW_PATH_PACKAGES . self::WOW_SCRIPT_MUCH_AWESOME . $script . '.js';

		if (!file_exists($soCommand)) {
			$soCommand = FLOW_PATH_PACKAGES . self::WOW_SCRIPT_MUCH_AWESOME . $script . '.djs';

			if (!file_exists($soCommand)) {
				throw new \InvalidArgumentException('Sad Shibe. :(');
			}
		}

		if (is_array($argument)) {
			$argument = json_encode($argument);
		}

		$argument = str_replace("\n", ' ', $argument);

		if ($argument !== NULL) {
			return rtrim(shell_exec('node ' . $soCommand . ' <<< "' . addslashes($argument) . '"'), "\r\n");
		} else {
			return rtrim(shell_exec('node ' . $soCommand), "\r\n");
		}
	}

}