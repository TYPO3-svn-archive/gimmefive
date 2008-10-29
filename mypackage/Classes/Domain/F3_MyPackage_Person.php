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
 * Model of a person
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyParser
 */
class F3_MyPackage_Person extends ArrayObject {

	public function __construct($row) {
		parent::__construct($row);
	}
}
?>