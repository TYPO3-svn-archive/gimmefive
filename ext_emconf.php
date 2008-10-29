<?php

########################################################################
# Extension Manager/Repository config file for ext: "gimmefive"
#
# Auto generated 17-10-2008 10:31
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Some backported Aspects of FLOW3',
	'description' => 'A Backport of some aspects of FLOW3: component manager, object cache, dependency injection (constructor), auto wiring. Example Package included. Requires at least PHP 5.2',
	'category' => 'misc',
	'shy' => 0,
	'version' => '0.0.3',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
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
	'_md5_values_when_last_written' => 'a:30:{s:12:"ext_icon.gif";s:4:"e499";s:52:"Classes/Component/F3_GimmeFive_Component_Manager.php";s:4:"bd35";s:48:"Classes/Package/F3_GimmeFive_Package_Manager.php";s:4:"7320";s:24:"Documentation/ReadMe.txt";s:4:"6e60";s:24:"mypackage/ext_emconf.php";s:4:"ecbf";s:22:"mypackage/ext_icon.gif";s:4:"e499";s:24:"mypackage/ext_tables.php";s:4:"24c5";s:64:"mypackage/Classes/Controller/F3_MyPackage_AbstractController.php";s:4:"9fae";s:59:"mypackage/Classes/Controller/F3_MyPackage_Configuration.php";s:4:"165e";s:53:"mypackage/Classes/Controller/F3_MyPackage_Content.php";s:4:"bda5";s:65:"mypackage/Classes/Controller/F3_MyPackage_ControllerInterface.php";s:4:"925a";s:64:"mypackage/Classes/Controller/F3_MyPackage_Controller_Default.php";s:4:"f627";s:56:"mypackage/Classes/Controller/tx_MyPackage_Dispatcher.php";s:4:"69c9";s:48:"mypackage/Classes/Domain/F3_MyPackage_Person.php";s:4:"43af";s:35:"mypackage/Classes/Domain/ReadMe.txt";s:4:"48b9";s:60:"mypackage/Classes/Repository/F3_MyPackage_AbstractSource.php";s:4:"3d36";s:59:"mypackage/Classes/Repository/F3_MyPackage_ObjectFactory.php";s:4:"877c";s:56:"mypackage/Classes/Repository/F3_MyPackage_Repository.php";s:4:"2e53";s:56:"mypackage/Classes/Repository/F3_MyPackage_Source_SQL.php";s:4:"d009";s:52:"mypackage/Classes/View/F3_MyPackage_AbstractView.php";s:4:"2e55";s:52:"mypackage/Classes/View/F3_MyPackage_View_Default.php";s:4:"c9eb";s:44:"mypackage/Configuration/Components/setup.txt";s:4:"8a65";s:42:"mypackage/Configuration/Settings/setup.txt";s:4:"305a";s:42:"mypackage/Resources/Language/locallang.xml";s:4:"4dea";s:59:"mypackage/Resources/Template/F3_MyPackage_View_Default.html";s:4:"47b9";s:49:"Tests/F3_GimmeFive_Component_Manager_testcase.php";s:4:"ed22";s:50:"Tests/F3_GimmeFive_Component_ObjectBuilderTest.php";s:4:"d253";s:50:"Tests/Fixtures/F3_GimmeFive_Fixture_DummyClass.php";s:4:"8a9c";s:56:"Tests/Fixtures/F3_GimmeFive_Fixture_SecondDummyClass.php";s:4:"3bfd";s:67:"Tests/Fixtures/F3_GimmeFive_Fixture_Validation_ClassWithSetters.php";s:4:"5d70";}',
);

?>