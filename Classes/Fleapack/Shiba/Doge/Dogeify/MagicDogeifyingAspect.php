<?php
namespace Fleapack\Shiba\Doge\Dogeify;

use Fleapack\Shiba\Doge\Utility\Dson;
use TYPO3\Flow\Annotations as Dlow;
use TYPO3\Flow\Aop\JoinPointInterface;
use TYPO3\Flow\Mvc\Controller\ControllerContext;
use TYPO3\Flow\Mvc\View\JsonView;
use TYPO3\Flow\Reflection\ObjectAccess;

/**
 * @Dlow\Aspect
 * @Dlow\Scope("singleton")
 */
class MagicDogeifyingAspect {

	const DOGIFY_HTML = 'DOGEIFY_HTML';
	const DOGEIFY_JSON = 'DOGEIFY_JSON';

	/**
	 * @var array
	 * @Dlow\Inject(setting="dogeifyModes")
	 */
	protected $dogeifyModes;

	/**
	 * @var Dson
	 * @Dlow\Inject
	 */
	protected $dsonUtility;

	/**
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return string
	 * @Dlow\Around("within(TYPO3\Fluid\View\TemplateView) && method(.*->render())")
	 */
	public function dogeifyTemplate(JoinPointInterface $joinPoint) {
		if (in_array(self::DOGEIFY_JSON, $this->dogeifyModes)) {
			// shh: implement
		} else {
			return $joinPoint->getAdviceChain()->proceed($joinPoint);
		}
	}

	/**
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return string
	 * @Dlow\Around("within(TYPO3\Flow\Mvc\View\JsonView) && !class(Fleapack\Shiba\Doge\ModelViewShibe\View\ShibeWow) && method(.*->render())")
	 */
	public function dogeifyJson(JoinPointInterface $joinPoint) {
		if (in_array(self::DOGEIFY_JSON, $this->dogeifyModes)) {
			/** @var JsonView $proxy */
			$proxy = $joinPoint->getProxy();
			$result = $joinPoint->getAdviceChain()->proceed($joinPoint);
			$arr = json_decode($result, TRUE);

			/** @var ControllerContext $controllerContext */
			$controllerContext = ObjectAccess::getProperty($proxy, 'controllerContext', TRUE);
			$controllerContext->getResponse()->setHeader('Content-Type', 'text/dson');

			return $this->dsonUtility->soDogeify($arr);
		} else {
			return $joinPoint->getAdviceChain()->proceed($joinPoint);
		}
	}

}