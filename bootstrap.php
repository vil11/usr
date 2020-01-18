<?php

// system settings
ini_set('display_errors', true);

// constants
define('BP', dirname(__FILE__));
define('PROJECT_PATH', realpath(__DIR__));
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

// autoloader for Helper lib
$pathToHelperLib = PROJECT_PATH . DS . 'libs' . DS . 'helper';
require_once($pathToHelperLib . DS . 'functions' . DS . 'array.php');
require_once($pathToHelperLib . DS . 'functions' . DS . 'directory.php');
require_once($pathToHelperLib . DS . 'functions' . DS . 'read.php');
require_once($pathToHelperLib . DS . 'functions' . DS . 'string.php');
require_once($pathToHelperLib . DS . 'functions' . DS . 'url.php');
require_once($pathToHelperLib . DS . 'functions' . DS . 'zend.php');

// autoloader for inside classes
require_once('autoload.php');
spl_autoload_register(array('legionAutoloader', 'autoload'));