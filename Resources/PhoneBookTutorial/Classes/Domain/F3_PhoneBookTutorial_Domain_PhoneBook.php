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
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBook.php 831 2008-05-10 15:43:22Z k-fish $
 */

/**
 * The representation of a simple phone book - a phone book model.
 * 
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBook.php 831 2008-05-10 15:43:22Z k-fish $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_PhoneBookTutorial_Domain_PhoneBook implements IteratorAggregate {

	/**
	 * @var ArrayObject Phone book entries of this phonebook
	 */
	protected $entries;

	/**
	 * @var string The name of this phonebook
	 */
	protected $name;

	/**
	 * @var string		Unique identifier of this model
	 */
	protected $UUID;

	/**
	 * @var F3_FLOW3_Component_ManagerInterface $componentManager: A reference to the Component Manager
	 */
	protected $componentManager;

	/**
	 * Constructor
	 *
	 * @param  F3_FLOW3_Component_ManagerInterface		$componentManager: A reference to the Component Manager
	 * @author Robert Lemke <robert@typo3.org>
	 */
	// public function __construct(F3_FLOW3_Component_ManagerInterface $componentManager, F3_TYPO3CR_Repository $repository) {
	public function __construct(F3_FLOW3_Component_ManagerInterface $componentManager) {
		$this->componentManager = $componentManager;
		$this->UUID = $componentManager->getComponent('F3_FLOW3_Utility_Algorithms')->generateUUID();
	}

	/**
	 * Adds entries as F3_PhoneBookTutorial_Domain_PhoneBookEntry to the Phone Book
	 *
	 * @param array $phoneBookNode
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	public function load($phoneBookNode) {
		$phoneBookEntryNodes = $phoneBookNode['phoneBookEntries'];
		foreach ($phoneBookEntryNodes as $phoneBookEntryNode) {
			$phoneBookEntry = $this->componentManager->getComponent('F3_PhoneBookTutorial_Domain_PhoneBookEntry');
			$phoneBookEntry->load($phoneBookEntryNode);
			$this->addEntry($phoneBookEntry);
		}
	} 

	/**
	 * Returns the universally unique identifier of this model entity
	 * 
	 * @return string						The UUID
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getUUID() {
		return $this->UUID;
	}

	/**
	 * Initializes this phone book
	 * 
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function initializeComponent() {
		$this->entries = new ArrayObject;
		$this->name = uniqid();
	}

	/**
	 * Sets the name of this phone book
	 * 
	 * @param  string							$name: The name of this phone book
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the name of this phone book
	 * 
	 * @return string The name
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Adds a new entry.
	 *
	 * @param F3_PhoneBookTutorial_Domain_PhoneBookEntry $entry
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function addEntry(F3_PhoneBookTutorial_Domain_PhoneBookEntry $entry) {
		$this->entries[] = $entry;
	}

	/**
	 * Removes a phone book from the phone book repository.
	 *
	 * @param  F3_PhoneBookTutorial_Domain_PhoneBookEntry $entry The phone book entry to remove
	 * @return void
	 * @throws F3_PhoneBookTutorial_Exception_UnknownPhoneBookEntry if the phone book entry didn't exist
	 * @author Robert Lemke <robert@typo3.org>
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function removeEntry(F3_PhoneBookTutorial_Domain_PhoneBookEntry $entry) {
		$foundEntry = FALSE;
		foreach ($this->entries as $index => $currentEntry) {
			if ($currentEntry === $entry) {
				unset ($this->entries[$index]);
				$foundEntry = TRUE;
				break;
			}
		}
		if ($foundEntry === FALSE) throw new F3_PhoneBookTutorial_Exception_UnknownPhoneBookEntry('Unknown phone book entry "' . $entry->getFirstname() . ' ' . $entry->getLastname() . '".', 1190209131);
	}

	/**
	 * Returns all phone book entries
	 * 
	 * @return array An array of phone book entries
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getEntries() {
		return $this->entries;
	}

	/**
	 * Returns an iterator which allows to iterate of the phone book entries
	 * 
	 * @return IteratorIterator A phone book entries iterator
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getIterator() {
		return new IteratorIterator($this->entries);
	}

}

?>