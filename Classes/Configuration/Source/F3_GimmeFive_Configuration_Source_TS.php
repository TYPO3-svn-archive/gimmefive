<?php
declare(ENCODING = 'utf-8');

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
 * @package GimmeFive
 * @subpackage Configuration
 */

/**
 * Configuration source based on TS settings
 *
 * @package GimmeFive
 * @subpackage Configuration
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_GimmeFive_Configuration_Source_TS {

	/**
	 * Loads the specified TypoScript configuration file and returns its content in a
	 * configuration container. If the file does not exist or could not be loaded,
	 * the empty configuration container is returned.
	 *
	 * @param string $pathAndFilename Full path and file name of the file to load
	 * @return F3_GimmeFive_Configuration_Container
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	 public static function loadTS($packageKey, $configurationType, $pathAndFilename) {
		$typoScript = t3lib_div::getURL($pathAndFilename);
		$parser = new t3lib_tsparser();
		$parser->parse($typoScript);
		$settings = $parser->setup['plugin.']['F3_' . $packageKey . '.'][$configurationType . '.'];
		$c = new F3_GimmeFive_Configuration_Container();
		$c->mergeWithTS($settings);
		return $c;
	}

}
?>