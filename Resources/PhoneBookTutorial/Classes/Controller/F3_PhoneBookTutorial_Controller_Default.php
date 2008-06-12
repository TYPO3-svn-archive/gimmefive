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
 * @version $Id: F3_PhoneBookTutorial_Controller_Default.php 848 2008-05-17 18:50:46Z k-fish $
 */

/**
 * The default phone book controller
 *
 * @package PhoneBookTutorial
 * @version $Id: F3_PhoneBookTutorial_Controller_Default.php 848 2008-05-17 18:50:46Z k-fish $
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class F3_PhoneBookTutorial_Controller_Default extends F3_FLOW3_MVC_Controller_ActionController {

	/**
	 * @var F3_PhoneBookTutorial_Domain_PhoneBookRepository The phone book repository
	 */
	protected $phoneBookRepository;

	/**
	 * @var F3_PhoneBookTutorial_Domain_PhoneBook The currently selected phone book
	 */
	protected $phoneBook;

	/**
	 * Sets the phone book repository used in the controller
	 *
	 * @param  F3_PhoneBookTutorial_Domain_PhoneBookRepository $phoneBookRepository: The phone book repository
	 * @return void
	 * @required
	 */
	public function injectPhoneBookRepository(F3_PhoneBookTutorial_Domain_PhoneBookRepository $phoneBookRepository) {
		$this->phoneBookRepository = $phoneBookRepository;
	}

	/**
	 * Initializes this controller
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function initializeController() {
		$this->supportedRequestTypes = array('F3_FLOW3_MVC_Web_Request');

		$this->arguments->addNewArgument('firstName')->setShortHelpMessage('First name of a person.')->setShortName('p');
		$this->arguments->addNewArgument('lastName')->setShortHelpMessage('Last name of a person.')->setShortName('l');
		$this->arguments->addNewArgument('phoneNumber')->setShortHelpMessage('The phone number.')->setShortName('n');

		$this->phoneBook = $this->phoneBookRepository->findPhoneBookByName('Tuebingen');

		$baseTemplateMarkup = file_get_contents($this->packageManager->getPackagePath('PhoneBookTutorial') . 'Resources/Templates/MainLayout.html');
		$this->baseView = $this->componentManager->getComponent('F3_FLOW3_MVC_View_Template');
		$this->baseView->setTemplateResource($baseTemplateMarkup);
	}

	/**
	 * The default action of this phonebook controller
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function defaultAction() {
		$this->showPhoneBookAction();
	}

	/**
	 * Lists all phone book entries of our phonebook
	 *
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function showPhoneBookAction() {
		$subView = $this->componentManager->getComponent('F3_PhoneBookTutorial_View_PhoneBookEntries');
		$subView->setPhoneBook($this->phoneBook);

		$this->baseView->setMarkerContent('REQUEST_BASEURI', $this->request->getBaseURI());
		$this->baseView->setPartContent('CONTENT', $subView->render());
		$this->response->setContent($this->baseView->render());
	}

	/**
	 * Adds a new entry to the phonebook
	 *
	 * @return void
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function addEntryAction() {
		$this->baseView->setMarkerContent('REQUEST_BASEURI', $this->request->getBaseURI());
		$this->baseView->setPartContent('CONTENT', '<p>Entry has been added.</p><p><a href="' . $this->request->getBaseURI() . 'PhoneBookTutorial/Default/showPhoneBook">Back</a></p>');
		$this->response->setContent($this->baseView->render());
	}

}
?>