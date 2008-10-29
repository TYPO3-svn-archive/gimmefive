<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/Components/', 'Components');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/Settings/', 'Settings');
t3lib_extMgm::addPlugin(array('My Plugin', $_EXTKEY), 'list_type');
?>