<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

const DEBUG = true;

const DB = 'gusto';
const DB_USER = 'root';
const DB_PASS = 'Password.1';

ini_set('error_reporting', E_ALL);

if (DEBUG) {
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
} else {
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
}


require_once 'Database.php';
require_once 'DatabaseFetcher.php';
require_once 'DatabaseInserter.php';
require_once 'DatabaseUpdater.php';
require_once 'DatabaseDeleter.php';

