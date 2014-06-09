<?php
namespace Fleapack\Shiba\Doge\Utility;

use TYPO3\Flow\Annotations as Dlow;

class Dogeify {

	/**
	 * @var float
	 * @Dlow\Inject(setting="dogeifyRatio")
	 */
	protected $dogeifyRatio;

	/**
	 * @var int
	 */
	protected $dogeify = 900;

	/**
	 * @var array
	 */
	protected $words = array(
		'plz', 'very', 'so', 'such', 'wow', 'shibe', 'shiba', 'amaze', 'excite', 'how'
	);

	public function initializeObject() {
		$this->dogeify = 1000 - (1000 * (float) $this->dogeifyRatio);
	}

	/**
	 * @param plz $wow
	 * @return very
	 */
	public function dogeifyText($wow) {
		$save = array();
		$words = str_word_count($wow, 1, '<>/');

		foreach ($words as $word) {
			$rand = rand(0, 1000);
			$includeFirst = $rand % 2 === 0;

			if ($includeFirst === FALSE) {
				$save[] = $word;
			}

			if ($rand > $this->dogeify)
				$save[] = $this->getRandomWord($rand);

			if ($includeFirst === TRUE) {
				$save[] = $word;
			}
		}

		return ucfirst(implode(' ', $save));
	}

	/**
	 * @param int $rand
	 * @return string
	 */
	protected function getRandomWord($rand) {
		$num = ($rand % count($this->words));
		return $this->words[$num];
	}

}