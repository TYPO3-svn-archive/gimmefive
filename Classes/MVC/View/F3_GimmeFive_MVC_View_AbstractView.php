<?php
/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * An abstract view
 *
 * @author	Jochen Rau <j.rau@web.de>
 * @package	F3_GimmeFive
 * @subpackage	MVC
 */
abstract class F3_GimmeFive_MVC_View_AbstractView extends tslib_pibase {	

	public $cObj;
	public $piVars;

	/**
	 * @var F3_FLOW3_Component_ManagerInterface A reference to the Component Manager
	 */
	protected $componentManager;

	/**
	 * @var F3_FLOW3_Package_ManagerInterface A reference to the Package Manager
	 */

	protected $settings;
	protected $model;
	protected $subparts;
	protected $typolinkConf;

	/**
	 * Constructs the view.
	 *
	 * @param F3_FLOW3_Component_ManagerInterface $componentManager A reference to the Component Manager
	 * @param F3_FLOW3_Package_ManagerInterface $packageManager A reference to the Package Manager
	 * @param F3_GimmeFive_Configuration_Manager $configurationManager A reference to the Configuration Manager
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	public function __construct(F3_FLOW3_Component_ManagerInterface $componentManager, F3_FLOW3_Package_ManagerInterface $packageManager, F3_GimmeFive_Configuration_Manager $configurationManager) {
		$this->componentManager = $componentManager;
		$this->packageManager = $packageManager;
		$this->settings = $configurationManager->getConfiguration($this->extKey, 'Settings');
		$this->conf = $this->settings; // only for backwards compatibility with tslib_pibase
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->setCurrentVal($GLOBALS['TSFE']->id);
		$this->typolinkConf['parameter.']['current'] = 1;
		parent::__construct();
		$this->pi_loadLL();
		$this->initializeView();
	}
	
	public function setModel($model) {
		$this->model = $model;
	}
	
	public function setTemplate($templateFile, $templateName, $forceTemplate = FALSE) {
		// if ($this->settings->offsetGet('templateFile') != '') $templateFile = $this->settings->offsetGet('templateFile');
		// if (preg_match('/^fileadmin\//', $templateFile) && $forceTemplate === FALSE) {
		// 	$templatePathAndFilename = PATH_site . $templateFile;
		// } else {
			$templatePathAndFilename = $this->packageManager->getPackagePath($this->extKey) . 'Resources/Template/' . $templateFile;
		// }
		
		if (!isset($templatePathAndFilename) || !file_exists($templatePathAndFilename)) throw new Exception('Template file "' . $templatePathAndFilename . '"not found.');

		$this->templateCode = file_get_contents($templatePathAndFilename);
		$this->subparts['template'] = $this->cObj->getSubpart($this->templateCode,'###TEMPLATE_' . F3_PHP6_Functions::strtoupper($templateName) . '###');
	}
		
	/**
	 * Overwrite this method to extend the initialization of the View
	 *
	 * @return void
	 */
	public function initializeView() {
	}
	
	/**
	 * Renders the view
	 *
	 * @return string The rendered view
	 */
	abstract public function render();

}
?>