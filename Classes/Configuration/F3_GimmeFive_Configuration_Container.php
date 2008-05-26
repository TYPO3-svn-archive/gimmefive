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
 * Configuration Container of the extension 'gimmefive'.
 *
 * @package	GimmeFive
 * @subpackage	Configuration
 */
class F3_GimmeFive_Configuration_Container extends F3_FLOW3_Configuration_Container {

	/**
	 * Merges this container with an array already build from TS
	 *
	 * @param array $setup The array
	 * @return F3_GimmeFive_Configuration_Container This container
	 * @author JochenRau <jochen.rau@typoplanet.de>
	 */
	public function mergeWithTS($setup) {
		if (is_array($setup)) {
			foreach ($setup as $optionName => $newOptionValue) {
				$optionName = preg_match('/(.*)\.{0,1}$/Uu',$optionName, $matches); // remove postfixed dot
				$optionName = $matches[1];
				if (is_array($newOptionValue)) {
					$existingOptionValue = $this->__get($optionName);
					if (!($existingOptionValue instanceof F3_GimmeFive_Configuration_Container)) $existingOptionValue = new F3_GimmeFive_Configuration_Container();
					$newOptionValue = $existingOptionValue->mergeWithTS($newOptionValue);
				}
				$this->__set($optionName, $newOptionValue);
			}
		}
		return $this;
	}

}
?>