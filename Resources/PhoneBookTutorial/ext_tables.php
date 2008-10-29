<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/', 'Setup');
t3lib_extMgm::addPlugin(array('The Phone Book', $_EXTKEY), 'list_type');

t3lib_extMgm::allowTableOnStandardPages('F3_PhoneBookTutorial_PhoneBooks');
t3lib_extMgm::addToInsertRecords('F3_PhoneBookTutorial_PhoneBooks');

$TCA["F3_PhoneBookTutorial_PhoneBooks"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:PhoneBookTutorial/Resources/Language/locallang_db.xml:F3_PhoneBookTutorial_PhoneBooks',		
		'label'     => 'phoneBookName',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE, 
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l18n_parent',	
		'transOrigDiffSourceField' => 'l18n_diffsource',	
		'default_sortby' => "ORDER BY sorting",	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_f3_phonebook.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, starttime, endtime, fe_group, phoneBookName",
	)
);


t3lib_extMgm::allowTableOnStandardPages('F3_PhoneBookTutorial_PhoneBookEntries');
t3lib_extMgm::addToInsertRecords('F3_PhoneBookTutorial_PhoneBookEntries');

$TCA["F3_PhoneBookTutorial_PhoneBookEntries"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:PhoneBookTutorial/Resources/Language/locallang_db.xml:F3_PhoneBookTutorial_PhoneBookEntries',		
		'label'     => 'lastName',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE, 
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l18n_parent',	
		'transOrigDiffSourceField' => 'l18n_diffsource',	
		'default_sortby' => "ORDER BY sorting",	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_f3_entry.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, starttime, endtime, fe_group, firstName, lastName, phoneNumber, phoneBookUid",
	)
);
?>