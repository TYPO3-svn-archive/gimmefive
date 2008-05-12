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
 * A Factory class to build objects
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
class F3_MyPackage_ObjectFactory {
	protected $componentManager;
	protected $configuration;

	public function __construct(F3_GimmeFive_Component_Manager $componentManager, F3_MyPackage_Configuration $configuration) {
		$this->componentManager = $componentManager;
		$this->configuration = $configuration;
	}
	
	public function buildObjects($source, $rows) {
		foreach ($rows as $row) {
			$objects[] = $this->componentManager->getComponent('F3_MyPackage_Person', $row);
		}
		return $objects;
	}
}	
?>