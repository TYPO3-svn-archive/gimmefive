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
 * @version $Id: F3_PhoneBookTutorial_View_PhoneBookEntries.php 862 2008-05-22 13:24:04Z k-fish $
 */

/**
 * A phone book entries view
 *
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_View_PhoneBookEntries.php 862 2008-05-22 13:24:04Z k-fish $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_PhoneBookTutorial_View_PhoneBookEntries extends F3_FLOW3_MVC_View_AbstractView {

	/**
	 * @var F3_PhoneBookTutorial_Domain_PhoneBook The model of this view
	 */
	protected $phoneBook;

	/**
	 * Sets the model for this view: The Phone Book
	 *
	 * @param  F3_PhoneBookTutorial_Domain_PhoneBook $phoneBook: The phonebook to display the entries of
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setPhoneBook(F3_PhoneBookTutorial_Domain_PhoneBook $phoneBook) {
		$this->phoneBook = $phoneBook;
	}

	/**
	 * Renders a list of PhoneBookEntries
	 */
	public function render() {
		$HTML = '<table><tr><th>First Name</th><th>Last Name</th><th>Phone Number</th></tr>';
		foreach ($this->phoneBook->getIterator() as $phoneBookEntry) {
			$HTML .= '<tr>';
			$HTML .= '<td>' . $phoneBookEntry->getFirstname() . '</td>';
			$HTML .= '<td>' . $phoneBookEntry->getLastname() . '</td>';
			$HTML .= '<td>' . $phoneBookEntry->getPhoneNumber() . '</td>';
			$HTML .= '</tr>';
		}
		$HTML .= '</table>';
		return $HTML;
	}
}
?>