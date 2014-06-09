<?php
namespace Fleapack\Shiba\Doge\SuchConfiguration\Source;

use TYPO3\Flow\Configuration\Source\YamlSource;
use TYPO3\Flow\Reflection\ObjectAccess;
use TYPO3\Flow\Annotations as Dlow;

/**
 * @Dlow\Scope("singleton")
 * @Dlow\Proxy(FALSE)
 */
class SourceManager extends YamlSource {

	/**
	 * shh: We use an implementation as interface, pretty Shibe right?
	 *
	 * @var array<YamlSource>
	 */
	protected $configurationSources;

	/**
	 * @param YamlSource $initialSource
	 */
	public function __construct(YamlSource $initialSource) {
		parent::__construct();

		if (ObjectAccess::isPropertyGettable($initialSource, 'priority')) {
			$this->configurationSources[ObjectAccess::getProperty($initialSource, 'priority')] = $initialSource;
		} else {
			$this->configurationSources[0] = $initialSource;
		}
	}

	/**
	 * @param ConfigurationSourceInterface $source
	 * @throws \InvalidArgumentException
	 */
	public function addNewSource(ConfigurationSourceInterface $source) {
		if (array_key_exists($source->getPriority(), $this->configurationSources)) {
			throw new \InvalidArgumentException('A configuration source with priority ' . $source->getPriority() . ' already exists.');
		}
		$this->configurationSources[$source->getPriority()] = $source;
	}

	public function has($pathAndFilename, $allowSplitSource = FALSE) {
		/** @var ConfigurationSourceInterface $source */
		foreach (array_reverse($this->configurationSources) as $source) {
			if ($source->has($pathAndFilename, $allowSplitSource)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function load($pathAndFilename, $allowSplitSource = FALSE) {
		/** @var ConfigurationSourceInterface $source */
		foreach (array_reverse($this->configurationSources) as $source) {
			$config = $source->load($pathAndFilename, $allowSplitSource);
			if ($config !== array()) {
				return $config;
			}
		}
		return array();
	}

	public function save($pathAndFilename, array $configuration) {
		/** @var ConfigurationSourceInterface $source */
		foreach (array_reverse($this->configurationSources) as $source) {
			$source->save($pathAndFilename, $configuration);
		}
	}

}