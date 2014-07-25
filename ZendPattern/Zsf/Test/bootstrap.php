<?php
$vendorDirectory = '../../../vendor';
if (file_exists($vendorDirectory . '/autoload.php')) {
	$loader = include $vendorDirectory . '/autoload.php';
	$loader->add('ZendPattern', '../../../');
}
define ('TESTDIR',realpath(dirname(__FILE__)));
