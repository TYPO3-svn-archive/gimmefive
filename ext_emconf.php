<?php

########################################################################
# Extension Manager/Repository config file for ext: "gimmefive"
#
# Auto generated 14-02-2008 12:12
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
	'version' => '0.0.1',
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
	'_md5_values_when_last_written' => '',
);

?>