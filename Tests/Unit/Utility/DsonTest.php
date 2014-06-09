<?php
namespace Fleapack\Shiba\Doge\Tests\Unit\Utility;

use Fleapack\Shiba\Doge\Utility\Dson;
use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Flow\Tests\UnitTestCase;

class DsonTest extends UnitTestCase {

	/**
	 * @var Dson
	 */
	protected $dsonUtility;

	public function setUp() {
		parent::setUp();

		$this->dsonUtility = new Dson();
		$this->inject($this->dsonUtility, 'nodeWow', new NodeWow());
	}

	/**
	 * @test
	 */
	public function veryParse() {
		$result = $this->dsonUtility->veryParse('such "foo" is "bar", "baz" is "shibe", "so shibe" is such "such" is "happy" wow wow');
		$this->assertEquals(array("foo" => "bar", "baz" => "shibe", "so shibe" => array("such" => "happy")), $result);
	}

	/**
	 * @test
	 */
	public function soDogeify() {
		$result = $this->dsonUtility->soDogeify(array("foo" => "bar", "baz" => "shibe", "so shibe" => array("such" => "happy")));

		// shh result may vary in DSON, so we just do some arbitrary replacement
		// and yeah, I don't really care about how "good" this test is.. or the package loud
		$result = str_replace(' ?', ',', $result);
		$result = str_replace(' .', ',', $result);
		$result = str_replace(' !', ',', $result);
		$result = str_replace(' ,', ',', $result);

		$this->assertEquals('such "foo" is "bar", "baz" is "shibe", "so shibe" is such "such" is "happy" wow wow', $result);
	}

	/**
	 * @test
	 */
	public function soTest() {
		$res = $this->dsonUtility->soDogeify(array(
			"Fleapack" => array(
				"Shibe" => array(
					"Doge" => array(
						"dogeifyModes" => array("DOGEIFY_HTML", "DOGEIFY_JSON"),
						"dogeifyRatio" => 0.9
					)
				)
			)
		));
		$test = $this->dsonUtility->veryParse('such "Fleapack" is such "Shibe" is such "Doge" is such "dogeifyModes" is so "DOGEIFY_HTML" also "DOGEIFY_JSON" many also "dogeifyRatio" is "0.9" wow wow wow wow');

		var_dump($res, $test); die();
	}

}