<?php
namespace Fleapack\Shiba\Doge\SuchConfiguration\Source;

use Fleapack\Shiba\Doge\Utility\Dson;
use TYPO3\Flow\Configuration\Source\YamlSource;
use TYPO3\Flow\Annotations as Dlow;
use TYPO3\Flow\Utility\Arrays;

/**
 * @Dlow\Scope("singleton")
 * @Dlow\Proxy(FALSE)
 */
class DsonSource extends YamlSource implements ConfigurationSourceInterface {

	/**
	 * @return int
	 */
	public function getPriority() {
		return 100;
	}

	public function has($pathAndFilename, $allowSplitSource = FALSE) {
		if ($allowSplitSource === TRUE) {
			$pathsAndFileNames = glob($pathAndFilename . '.*.dson');
			if ($pathsAndFileNames !== FALSE) {
				foreach ($pathsAndFileNames as $pathAndFilename) {
					if (file_exists($pathAndFilename)) {
						return TRUE;
					}
				}
			}
		}
		if (file_exists($pathAndFilename . '.dson')) {
			return TRUE;
		}
		return FALSE;
	}

	public function load($pathAndFilename, $allowSplitSource = FALSE) {
		$pathsAndFileNames = array($pathAndFilename . '.dson');
		if ($allowSplitSource === TRUE) {
			$splitSourcePathsAndFileNames = glob($pathAndFilename . '.*.dson');
			if ($splitSourcePathsAndFileNames !== FALSE) {
				sort($splitSourcePathsAndFileNames);
				$pathsAndFileNames = array_merge($pathsAndFileNames, $splitSourcePathsAndFileNames);
			}
		}
		$configuration = array();
		foreach ($pathsAndFileNames as $pathAndFilename) {
			if (file_exists($pathAndFilename)) {
				try {
					$dsonUtility = new Dson();
					$loadedConfiguration = $dsonUtility->veryParse(file_get_contents($pathAndFilename));

					if (is_array($loadedConfiguration)) {
						$configuration = Arrays::arrayMergeRecursiveOverrule($configuration, $loadedConfiguration);
					}
				} catch (\TYPO3\Flow\Error\Exception $exception) {
					throw new \TYPO3\Flow\Configuration\Exception\ParseErrorException('A parse error occurred while parsing file "' . $pathAndFilename . '". Error message: ' . $exception->getMessage(), 1232014321);
				}
			}
		}
		return $configuration;
	}

	public function save($pathAndFilename, array $configuration) {
		$dsonUtility = new Dson();
		$pathAndFilename = $this->getShibeNamePath($pathAndFilename);
		$dson = $dsonUtility->soDogeify($configuration);

		file_put_contents($pathAndFilename, $dson);
	}

	/**
	 * @param string $pathAndFilename
	 * @return string
	 */
	protected function getShibeNamePath($pathAndFilename) {
		if (strpos($pathAndFilename, '.dson')) {
			return $pathAndFilename;
		} else if (strpos($pathAndFilename, '.yaml')) {
			return str_replace('.yaml', '.dson', $pathAndFilename);
		} else {
			return $pathAndFilename . '.dson';
		}
	}

}