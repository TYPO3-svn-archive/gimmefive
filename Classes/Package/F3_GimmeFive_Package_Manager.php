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
 * Package Manager of the extension 'gimmefive'. This is a backport of the Package Manager of FLOW3. It's based
 * on code mainly written by Robert Lemke. Thanx to the FLOW3 team for all the great stuff!
 *
 * @package	TYPO3
 * @subpackage	F3_GimmeFive
 */
class F3_GimmeFive_Package_Manager {

	/**
	 * @var array Array of available packages, indexed by package key
	 */
	protected $packages = array();

	/**
	 * @var array List of active packages - not used yet!
	 */
	protected $arrayOfActivePackages = array();

	/**
	 * @var array Array of packages whose classes must not be registered as components automatically
	 */
	protected $componentRegistrationPackageBlacklist = array();

	/**
	 * @var array Array of class names which must not be registered as components automatically. Class names may also be regular expressions.
	 */
	protected $componentRegistrationClassBlacklist = array(
		'F3_FLOW3_AOP_.*',
		'F3_FLOW3_Component.*',
		'F3_FLOW3_Package.*',
		'F3_FLOW3_Reflection.*',
	);

	/**
	 * Initializes the package manager
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function initialize() {
		$this->packages = $this->scanAvailablePackages();
	}

	/**
	 * Returns TRUE if a package is available (the package's files exist in the pcakages directory)
	 * or FALSE if it's not. If a package is available it doesn't mean neccessarily that it's active!
	 *
	 * @param string $packageKey: The key of the package to check
	 * @return boolean TRUE if the package is available, otherwise FALSE
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function isPackageAvailable($packageKey) {
		if (!is_string($packageKey)) throw new InvalidArgumentException('The package key must be of type string, ' . gettype($packageKey) . ' given.', 1200402593);
		return (key_exists($packageKey, $this->packages));
	}

	/**
	 * Returns a F3_GimmeFive_Package_PackageInterface object for the specified package.
	 * A package is available, if the package directory contains valid meta information.
	 *
	 * @param string $packageKey
	 * @return F3_GimmeFive_Package The requested package object
	 * @throws F3_GimmeFive_Package_Exception_UnknownPackage if the specified package is not known
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getPackage($packageKey) {
		if (!$this->isPackageAvailable($packageKey)) throw new F3_GimmeFive_Package_Exception_UnknownPackage('Package "' . $packageKey . '" is not available.', 1166546734);
		return $this->packages[$packageKey];
	}

	/**
	 * Returns an array of F3_GimmeFive_Package_Meta objects of all available packages.
	 * A package is available, if the package directory contains valid meta information.
	 *
	 * @return array Array of F3_GimmeFive_Package_Meta
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getAvailablePackages() {
		return $this->packages;
	}

	/**
	 * Returns an array of F3_GimmeFive_Package_Meta objects of all active packages.
	 * A package is active, if it is available and has been activated in the package
	 * manager settings.
	 *
	 * @return array Array of F3_GimmeFive_Package_Meta
	 * @author Robert Lemke <robert@typo3.org>
	 * @todo Implement activation / deactivation of packages
	 */
	public function getActivePackages() {
		return $this->packages;
	}

	/**
	 * Returns the absolute path to the root directory of a package. Only
	 * works for package which have a proper meta.xml file - which they
	 * should.
	 *
	 * @param string $packageKey: Name of the package to return the path of
	 * @return string Absolute path to the package's root directory
	 * @throws F3_GimmeFive_Package_Exception_UnknownPackage if the specified package is not known
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getPackagePath($packageKey) {
		if (!$this->isPackageAvailable($packageKey)) throw new F3_GimmeFive_Package_Exception_UnknownPackage('Package "' . $packageKey . '" is not available.', 1166543253);
		return $this->packages[$packageKey]->getPackagePath();
	}

	/**
	 * Returns the absolute path to the "Classes" directory of a package.
	 *
	 * @param string $packageKey: Name of the package to return the "Classes" path of
	 * @return string Absolute path to the package's "Classes" directory, with trailing directory separator
	 * @throws F3_GimmeFive_Package_Exception_UnknownPackage if the specified package is not known
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getPackageClassesPath($packageKey) {
		if (!$this->isPackageAvailable($packageKey)) throw new F3_GimmeFive_Package_Exception_UnknownPackage('Package "' . $packageKey . '" is not available.', 1167574237);
		return $this->packages[$packageKey]->getClassesPath();
	}

	/**
	 * Scans all directories in the Packages/ directory for available packages.
	 * For each package a F3_GimmeFive_Package_ object is created and returned as
	 * an array.
	 *
	 * @return array An array of F3_GimmeFive_Package_Package objects for all available packages
	 * @author Robert Lemke <robert@typo3.org>
	 */
	protected function scanAvailablePackages() {
		$availablePackagesArr = array();
		$packagesDirectoryIterator = new DirectoryIterator(FLOW3_PATH_PACKAGES);
		while ($packagesDirectoryIterator->valid()) {
			$filename = $packagesDirectoryIterator->getFilename();
			if ($filename{0} != '.') {
				$availablePackagesArr[$filename] = new F3_GimmeFive_Package_Package($filename, ($packagesDirectoryIterator->getPathName() . '/'));
			}
			$packagesDirectoryIterator->next();
		}
		return $availablePackagesArr;
	}
}

?>