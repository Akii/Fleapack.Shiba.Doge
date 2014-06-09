<?php
namespace Fleapack\Shiba\Doge\SuchConfiguration\Source;

interface ConfigurationSourceInterface {

	/**
	 * @return int
	 */
	public function getPriority();
	/**
	 * Checks for the specified configuration file and returns TRUE if it exists.
	 *
	 * @param string $pathAndFilename Full path and filename of the file to load, excluding the file extension (ie. ".yaml")
	 * @param boolean $allowSplitSource If TRUE, the type will be used as a prefix when looking for configuration files
	 * @return boolean
	 */
	public function has($pathAndFilename, $allowSplitSource = FALSE);

	/**
	 * Loads the specified configuration file and returns its content as an
	 * array. If the file does not exist or could not be loaded, an empty
	 * array is returned
	 *
	 * @param string $pathAndFilename Full path and filename of the file to load, excluding the file extension (ie. ".yaml")
	 * @param boolean $allowSplitSource If TRUE, the type will be used as a prefix when looking for configuration files
	 * @return array
	 * @throws \TYPO3\Flow\Configuration\Exception\ParseErrorException
	 */
	public function load($pathAndFilename, $allowSplitSource = FALSE);

	/**
	 * Save the specified configuration array to the given file in YAML format.
	 *
	 * @param string $pathAndFilename Full path and filename of the file to write to, excluding the dot and file extension (i.e. ".yaml")
	 * @param array $configuration The configuration to save
	 * @return void
	 */
	public function save($pathAndFilename, array $configuration);

}