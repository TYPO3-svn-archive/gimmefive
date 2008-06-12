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
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBookRepository.php 831 2008-05-10 15:43:22Z k-fish $
 */

/**
 * The phone book repository - a collection of all the phone books
 * 
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_Domain_PhoneBookRepository.php 831 2008-05-10 15:43:22Z k-fish $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_PhoneBookTutorial_Domain_PhoneBookRepository {

	/**
	 * @var F3_FLOW3_Component_ManagerInterface Component manager
	 */
	protected $componentManager;

	/**
	 * @var F3_TYPO3CR_Session Content Repository session
	 */
	protected $session;

	/**
	 * @var ArrayObject Phone books
	 */
	protected $phoneBooks;

	/**
	 * Initializes this repository
	 * 
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 * @todo Check for existance of our data node and create it if needed
	 */
	public function __construct(F3_FLOW3_Component_ManagerInterface $componentManager) {
		$this->componentManager = $componentManager;
		$this->phoneBooks = new ArrayObject;

		$phoneBookNodes = $this->fetchPhoneBooks();
		foreach ($phoneBookNodes as $phoneBookNode) {
			$phoneBook = $this->componentManager->getComponent('F3_PhoneBookTutorial_Domain_PhoneBook');
			$phoneBook->setName($phoneBookNode['phoneBookName']);
			$phoneBook->load($phoneBookNode);
			$this->addPhoneBook($phoneBook);
		}
	}

	/**
	 * Fetches all Phone Books
	 * 
	 * @return array $phoneBooks Phone Books
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	protected function fetchPhoneBooks() {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid, phoneBookName',
			'F3_PhoneBookTutorial_PhoneBooks',
			'1=1' . tslib_cObj::enableFields('F3_PhoneBookTutorial_PhoneBooks')
			);
		$phoneBooks = array();
		if ($res) {
			foreach ($res as $row) {
				$phoneBookEntries = $this->fetchPhoneBookEntries($row['uid']);
				$phoneBooks[$row['phoneBookName']] = array(
					'phoneBookName' => $row['phoneBookName'],
					'phoneBookEntries' => $phoneBookEntries,
					);
			}
		}
		return $phoneBooks;
	}
	
	/**
	 * Fetches all Phone Books Entries
	 * 
	 * @return array $phoneBooks Phone Books
	 * @author Jochen Rau <jochen.rau@typoplanet.de>
	 */
	protected function fetchPhoneBookEntries($phoneBookUid) {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'firstName, lastName, phoneNumber, phoneBookUid',
			'F3_PhoneBookTutorial_PhoneBookEntries ',
			'phoneBookUid=' . (int)$phoneBookUid . tslib_cObj::enableFields('F3_PhoneBookTutorial_PhoneBookEntries')
			);
		$phoneBookEntries = array();
		if ($res) {
			foreach ($res as $row) {
				$phoneBookEntries[] = array(
					'firstName' => $row['firstName'],
					'lastName' => $row['lastName'],
					'phoneNumber' => $row['phoneNumber']
					);
			}
		}
		return $phoneBookEntries;
	}
	
	

	/**
	 * Returns all phonebook entries.
	 * 
	 * @return ArrayObject The phone books
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function getPhoneBooks() {
		return $this->phoneBooks;
	}

	/**
	 * Sets all phonebook entries.
	 * 
	 * @param ArrayObject $phoneBooks The phone books
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function setPhoneBooks($phoneBooks) {
		$this->phoneBooks = $phoneBooks;
	}

	/**
	 * Adds a phone book to the phone book repository.
	 *
	 * @param  F3_PhoneBookTutorial_Domain_PhoneBook		$phoneBook: The new phone book
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function addPhoneBook(F3_PhoneBookTutorial_Domain_PhoneBook $phoneBook) {
		$this->phoneBooks[] = $phoneBook;
	}

	/**
	 * Removes a phone book from the phone book repository.
	 *
	 * @param  F3_PhoneBookTutorial_Domain_PhoneBook		$phoneBook: The phone book to remove
	 * @return void
	 * @throws F3_PhoneBookTutorial_Exception_UnknownPhoneBook if the phone book didn't exist
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function removePhoneBook(F3_PhoneBookTutorial_Domain_PhoneBook $phoneBook) {
		$foundPhoneBook = FALSE;
		foreach ($this->phoneBooks as $index => $currentPhoneBook) {
			if ($currentPhoneBook === $phoneBook) {
				unset ($this->phoneBooks[$index]);
				$foundPhoneBook = TRUE;
				break;
			}
		}
		if ($foundPhoneBook === FALSE) throw new F3_PhoneBookTutorial_Exception_UnknownPhoneBook('Unknown phone book "' . $phoneBook->getName() . '".', 1190209131);
	}

	/**
	 * Find a phone book by name
	 * 
	 * @param  string										$name: Name of the phone book
	 * @return F3_PhoneBookTutorial_Domain_PhoneBook|NULL		The phone book or NULL if none was found
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function findPhoneBookByName($name) {
		$foundPhoneBook = FALSE;
		foreach ($this->phoneBooks as $currentPhoneBook) {
			if ($currentPhoneBook->getName() === $name) {
				return $currentPhoneBook;
			}
		}
		return NULL;
	}
}

?>