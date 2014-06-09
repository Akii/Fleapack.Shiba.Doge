<?php
namespace Fleapack\Shiba\Doge\Controller;

use TYPO3\Flow\Mvc\Controller\ActionController;

class TestController extends ActionController {

	protected $viewFormatToObjectNameMap = array(
		'dson' => 'Fleapack\\Shiba\\Doge\\ModelViewShibe\\View\\ShibeWow',
		'json' => 'TYPO3\Flow\Mvc\View\JsonView'
	);

	public function showAction() {}

	public function dsonAction() {
		$this->view->assign('value', array("foo" => "bar", "baz" => "shibe", "so shibe" => array("such" => "happy")));
	}

}