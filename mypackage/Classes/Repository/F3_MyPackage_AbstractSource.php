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
 * Abstract data source for the MyPackage
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
abstract class F3_MyPackage_AbstractSource {
	protected $setup;
	protected $sourceName;

	public function __construct(array $setup) {
		$this->setSetup($setup);
		$this->setSourceName($this->setup['sourceName']);
	}
	
	abstract public function searchAll();
	
	public function setSetup($setup) {
		$this->setup = $setup;
	}
	
	public function getSetup() {
		return $this->setup;
	}
	
	public function setSourceName($sourceName) {
		$this->sourceName = $sourceName;
	}
	
	public function getSourceName() {
		return $this->sourceName;
	}	
}	
?>