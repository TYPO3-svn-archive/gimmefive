<?php

########################################################################
# Extension Manager/Repository config file for ext: "gimmefive"
#
# Auto generated 12-05-2008 11:34
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Simple Backport of FLOW3',
	'description' => 'Backport of some aspects of FLOW3: component manager, object cache, dependency injection (constructor), auto wiring. Requires at least PHP 5.2',
	'category' => 'misc',
	'shy' => 0,
	'version' => '0.0.2',
	'state' => 'alpha',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Jochen Rau',
	'author_email' => 'jochen.rau@typoplanet.de',
	'author_company' => 'typoplanet',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:8:{s:12:"ext_icon.gif";s:4:"e499";s:45:"Classes/Component/F3_GimmeFive_Component_Manager.php";s:4:"9dde";s:48:"Classes/Package/F3_GimmeFive_Package_Manager.php";s:4:"61c6";s:50:"Tests/F3_GimmeFive_Component_ObjectBuilderTest.php";s:4:"c3fa";s:49:"Tests/F3_Gimmefive_Component_Manager_testcase.php";s:4:"f686";s:50:"Tests/Fixtures/F3_GimmeFive_Fixture_DummyClass.php";s:4:"8a9c";s:56:"Tests/Fixtures/F3_GimmeFive_Fixture_SecondDummyClass.php";s:4:"3bfd";s:67:"Tests/Fixtures/F3_GimmeFive_Fixture_Validation_ClassWithSetters.php";s:4:"5d70";}',
	'suggests' => array(
	),
);

?>