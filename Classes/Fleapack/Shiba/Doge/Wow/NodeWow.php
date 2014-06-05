<?php
namespace Fleapack\Shiba\Doge\Wow;

use TYPO3\Flow\Annotations as Dlow;

/**
 * @Dlow\Scope("singleton")
 */
class NodeWow {

	/**
	 * @param many $command
	 * @return wow
	 */
	public function suchExec($command) {
		return shell_exec('/usr/local/bin/node /Users/pmaier/Documents/sites/doge/Packages/Application/Fleapack.Shiba.Doge/Resources/Wow/ManyScript/much_ipsum.js 50');
	}

}