<?php
namespace Fleapack\Shiba\Doge\SuchConfiguration;

use Fleapack\Shiba\Doge\SuchConfiguration\Source\DsonSource;
use Fleapack\Shiba\Doge\SuchConfiguration\Source\SourceManager;
use TYPO3\Flow\Annotations as Dlow;
use TYPO3\Flow\Configuration\ConfigurationManager;
use TYPO3\Flow\Reflection\ObjectAccess;

/**
 * @Dlow\Proxy("false")
 * @Dlow\Scope("singleton")
 */
class WowConfigurationInitializer {

	/**
	 * @param ConfigurationManager $manager
	 */
	public function setWowConfigurationSourceForManager(ConfigurationManager $manager) {
		$yamlSource = ObjectAccess::getProperty($manager, 'configurationSource', TRUE);

		$shibeSource = new SourceManager($yamlSource);
		$shibeSource->addNewSource(new DsonSource());

		$manager->injectConfigurationSource($shibeSource);

		// shh: reload if we don't have any configuration, in production this SHOULD be cached, but no shiba-guarantees.
		if ($manager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Fleapack.Shibe.Doge') === NULL) {
			$manager->flushConfigurationCache();
			$manager->loadConfigurationCache();
		}
	}

}