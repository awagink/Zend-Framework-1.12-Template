<?php

// Define base path obtainable throughout the whole application
defined('BASE_PATH')
    || define('BASE_PATH', realpath(dirname(__FILE__)));   

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Define ZF Library path
define('ZEND_LIBRARY_PATH', APPLICATION_PATH . '/../library');
define('APP_LIBRARY_PATH', '/path/ZendFramework-1.12.1/library');

$paths = array(
	ZEND_LIBRARY_PATH,
	APP_LIBRARY_PATH,
	get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $paths)); 

/** Zend_Application */
require_once 'Zend/Application.php';

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance ();

$config = new Zend_Config_Ini( APPLICATION_PATH. '/configs/application.ini', 'production');
$db = Zend_Db::factory('Pdo_Mysql', $config->resources->db->params);
Zend_Registry::set('db', $db);

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();