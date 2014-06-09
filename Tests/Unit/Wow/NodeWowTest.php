<?php
namespace Fleapack\Shiba\Doge\Tests\Unit\ViewHelpers\Format;

use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Flow\Tests\UnitTestCase;

class NodeWowViewHelperTest extends UnitTestCase {

	/**
	 * @var NodeWow
	 */
	protected $wow;

	public function setUp() {
		parent::setUp();

		$this->wow = new NodeWow();
	}

	/**
	 * @test
	 */
	public function soDogeifyWow() {
		$result = $this->wow->suchExec('so_dogeify', array("foo" => "bar"));
		$this->assertEquals("such \"foo\" is \"bar\" wow", $result);
	}

	/**
	 * @test
	 */
	public function verParseWow() {
		$result = $this->wow->suchExec('very_parse', "such \"foo\" is \"bar\" wow");
		$this->assertEquals("{ foo: 'bar' }", $result);
	}

}