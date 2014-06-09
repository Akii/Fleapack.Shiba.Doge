<?php
namespace Fleapack\Shiba\Doge\Dogeify;

use Fleapack\Shiba\Doge\Utility\Dogeify;
use Fleapack\Shiba\Doge\Utility\Dson;
use TYPO3\Flow\Annotations as Dlow;
use TYPO3\Flow\Aop\JoinPointInterface;
use TYPO3\Flow\Configuration\ConfigurationManager;
use TYPO3\Flow\Core\Bootstrap;
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
	 * @var Dogeify
	 * @Dlow\Inject
	 */
	protected $dogeifyUtility;

	/**
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return string
	 * @Dlow\Around("within(TYPO3\Fluid\View\TemplateView) && method(.*->render())")
	 */
	public function dogeifyTemplate(JoinPointInterface $joinPoint) {
		if (in_array(self::DOGIFY_HTML, $this->dogeifyModes)) {
			// shh: implement
			$html = $joinPoint->getAdviceChain()->proceed($joinPoint);

			$dogeify = $this->dogeifyUtility;
			$dogeifiedHtml = preg_replace_callback('/\<(title|h\d|p|span|b|i|u|a){1}(.*)\>([^\>]+)(\<\/\1\>){1}/', function($matches) use ($dogeify) {
				foreach ($matches as $match) {
					$openingTag = substr($match, 0, strpos($match, '>') +1);
					$closingTag = substr($match, strrpos($match, '<'), strlen($match));
					$content = substr($match, strlen($openingTag), strrpos($match, $closingTag) - strlen($openingTag));

					// shh: this breaks a lot with nested tags but shiba cares not
					return $openingTag . $dogeify->dogeifyText($content) . $closingTag;
				}
			}, $html);

			return $dogeifiedHtml;
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