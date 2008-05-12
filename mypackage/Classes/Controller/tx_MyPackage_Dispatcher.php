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

require_once (t3lib_extMgm::extPath('gimmefive') . 'Classes/Component/F3_GimmeFive_Component_Manager.php');

/**
 * The Dispatcher instatiates the Component Manager and delegates the process to the given controller.
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
class tx_MyPackage_Dispatcher {
	
	public function main($content, $setup) {
		// return 'Hello World!' . $content;
		$componentManager = F3_GimmeFive_Component_Manager::getInstance();
		$controller = $componentManager->getComponent($setup['controller']);
		if (isset($content)) {
			$controller->setContent($componentManager->getComponent('F3_MyPackage_Content', $content));
		}
		return $controller->process();
	}
}	
?>