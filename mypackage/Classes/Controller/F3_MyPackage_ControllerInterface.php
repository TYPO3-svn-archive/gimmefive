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
 * Controller interface of the 'mypackage'
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
interface F3_MyPackage_ControllerInterface {
	
	/**
	 * Sets the content object
	 *
	 * @return void
	 * @author Jochen Rau
	 */
	public function setContent($content);

	/**
	 * Returns the content object
	 *
	 * @return void
	 * @author Jochen Rau
	 */
	public function getContent();

	/**
	 * Process all
	 *
	 * @return void
	 * @author Jochen Rau
	 */
	public function process();
}
?>