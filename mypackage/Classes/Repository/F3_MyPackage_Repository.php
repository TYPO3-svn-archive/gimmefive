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
 * A collection of data sources for the mypackage
 *
 * @author	Jochen Rau <jochen.rau@typoplanet.de>
 * @package	TYPO3
 * @subpackage	F3_MyPackage
 */
class F3_MyPackage_Repository {
	protected $componentManager;
	protected $configuration;
	protected $sources;
	protected $catalog;

	public function __construct(F3_GimmeFive_Component_Manager $componentManager, F3_MyPackage_Configuration $configuration, F3_MyPackage_ObjectFactory $objectFactory) {
		$this->componentManager = $componentManager;
		$this->configuration = $configuration;
		$this->objectFactory = $objectFactory;
		$this->sources = $this->getSources();
	}
	
	/**
	 * Returns all (non-hidden an non deleted) terms in all configured sources.
	 */
	public function findAll() {
		return $this->getCatalog();
	}
	
	protected function getCatalog() {
		if (!isset($this->catalog)) {
			$objects = array();
			foreach ($this->sources as $source) {
				$objectsFromFactory = $this->objectFactory->buildObjects($source, $source->searchAll());
				if (is_array($objectsFromFactory)) {
					$objects = $objects + $objectsFromFactory;					
				}
			}			
			$this->catalog = $objects;			
		} else {
			$objects = $this->catalog;
		}
		return $objects;
	}
	
	protected function getSources() {
		$sources = array();
		$sourcesConfiguration = $this->configuration->getSourcesConfiguration();
		if (!isset($sourcesConfiguration)) throw new Exception('No sources configuration was found.');
		foreach ($sourcesConfiguration as $sourceKey => $sourceSetup) {
			$sourceSetup = array_merge(array('sourceKey' => substr($sourceKey, 0, -1)), $sourceSetup);
			if ($sourceSetup['sourceType'] === 'sql') {
				$sources[] = $this->componentManager->getComponent('F3_MyPackage_Source_SQL', $sourceSetup);
			}
		}
		return $sources;
	}
}	
?>