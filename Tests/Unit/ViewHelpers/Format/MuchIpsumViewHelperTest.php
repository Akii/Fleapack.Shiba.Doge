<?php
namespace Fleapack\Shiba\Doge\Tests\Unit\ViewHelpers\Format;

use Fleapack\Shiba\Doge\ViewHelpers\Format\MuchIpsumViewHelper;
use Fleapack\Shiba\Doge\Wow\NodeWow;
use TYPO3\Flow\Tests\UnitTestCase;

class MuchIpsumViewHelperTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function manyTestSoWow() {
		$vh = new MuchIpsumViewHelper();
		$this->inject($vh, 'suchObject', new NodeWow());
		var_dump($vh->render(50));
	}

}