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
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBookEntry.php 831 2008-05-10 15:43:22Z k-fish $
 */

/**
 * The representation of a phone book entry.
 * 
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBookEntry.php 831 2008-05-10 15:43:22Z k-fish $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 *
 * @scope prototype
 */
class F3_PhoneBookTutorial_Domain_PhoneBookEntry implements IteratorAggregate {

	/**
	 * @var string First name
	 */
	protected $firstName = '';

	/**
	 * @var string Last name
	 */
	protected $lastName = '';

	/**
	 * @var string The phone number
	 */
	protected $phoneNumber = '';

	/**
	 * @var string The UUID of this object
	 */
	protected $UUID = '';

	/**
	 * Adds data to the entry
	 * 
	 * @param array $phoneBookEntryNode
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	public function load($phoneBookEntryNode) {
		$this->setLastname((string) $phoneBookEntryNode['lastName']);
		$this->setFirstname((string) $phoneBookEntryNode['firstName']);
		$this->setPhoneNumber((string) $phoneBookEntryNode['phoneNumber']);
	}

	/**
	 * Sets the first name
	 *
	 * @param  string $firstName The first name
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setFirstname($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the first name
	 *
	 * @return string
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getFirstname() {
		return $this->firstName;
	}

	/**
	 * Sets the last name
	 *
	 * @param string $lastName The last name
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setLastname($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the last name
	 *
	 * @return string
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getLastname() {
		return $this->lastName;
	}

	/**
	 * Sets the phone number
	 *
	 * @param string $phoneNumber The phone number
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * Returns the phone number
	 *
	 * @return string
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * Returns a property iterator
	 *
	 * @return IteratorIterator The iterator
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getIterator() {
		$properties = new ArrayObject(array(
				'firstName' => $this->firstName,
				'lastName' => $this->lastName,
				'phoneNumber' => $this->phoneNumber
			)
		);
		return new IteratorIterator($properties);
	}
}

?>