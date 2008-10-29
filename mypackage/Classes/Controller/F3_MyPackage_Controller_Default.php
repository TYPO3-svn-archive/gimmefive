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
 * A default controller 
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
class F3_MyPackage_Controller_Default extends F3_MyPackage_AbstractController {
	protected $componentManager;
	protected $configuration;
	protected $repository;
	
	protected $piVars;
	
	public function __construct(F3_GimmeFive_Component_Manager $componentManager, F3_MyPackage_Configuration $configuration, F3_MyPackage_Repository $repository) {
		$this->componentManager = $componentManager;
		$this->configuration = $configuration;
		$this->repository = $repository;
		$this->initializeController();
	}
	
	/**
	 * Processes all. This could be refactored to several Action methods.
	 *
	 * @return mixed Output 
	 * @author Jochen Rau
	 */
	public function process() {
		$view = $this->componentManager->getComponent('F3_MyPackage_View_Default');
		$view->setModel($this->repository->findAll());
		$view->setTemplate('F3_MyPackage_View_Default.html', 'LIST');
		return $view->render();
	}
	
	protected function initializeController($value='') {
		$this->piVars = t3lib_div::GParrayMerged($this->configuration->getPrefixedPackageKey());
	}

}
?>