<?php
namespace Fleapack\Shiba\Doge;

use Fleapack\Shiba\Doge\SuchConfiguration\WowConfigurationInitializer;
use TYPO3\Flow\Configuration\ConfigurationManager;
use TYPO3\Flow\Core;

class Package extends \TYPO3\Flow\Package {

	/**
	 * Invokes custom PHP code directly after the package manager has been initialized.
	 *
	 * @param Core\Bootstrap $bootstrap The current bootstrap
	 * @return void
	 */
	public function boot(Core\Bootstrap $bootstrap) {
		$wowDispatcher = $bootstrap->getSignalSlotDispatcher();
		$wowDispatcher->connect('TYPO3\Flow\Configuration\ConfigurationManager', 'configurationManagerReady', function(ConfigurationManager $configurationManager) use ($bootstrap) {
			$configurationInitializer = new WowConfigurationInitializer();
			$configurationInitializer->setWowConfigurationSourceForManager($configurationManager);
		});
	}

}