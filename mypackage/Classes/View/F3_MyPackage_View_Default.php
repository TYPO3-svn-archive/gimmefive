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
 * A default view
 *
 * @author	Jochen Rau <j.rau@web.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
class F3_MyPackage_View_Default extends F3_MyPackage_AbstractView {

	public function render() {
		return '<p>Hi, this is the View! You have to comment out the appropriate line in the class "F3_MyPackage_View_Default" to get a full listing of addresses. Be sure to have tt_address installed or configure another table.</p>';
		foreach ($this->model as $key => $object) {
			$this->fillMarker($object, $markerArray, $wrappedSubpartArray);
			$subpartArray['###LIST###'] .= $this->cObj->substituteMarkerArrayCached($this->subparts['item'],$markerArray,$subpartArray,$wrappedSubpartArray);
		}
		$content = $this->cObj->substituteMarkerArrayCached($this->subparts['template'],$markerArray,$subpartArray,$wrappedSubpartArray);
		$content = $this->removeUnfilledMarker($content);
		return $this->pi_wrapInBaseClass($content);
	}
}
?>