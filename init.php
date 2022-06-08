<?php

require_once 'Database.php';
require_once 'DatabaseFetcher.php';
require_once 'DatabaseImager.php';

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

const DEBUG = true;

const DB = 'gusto';
const DB_USER = 'root';
const DB_PASS = 'Password.1';

const ABOUT_IMAGE = ROOT . '/img/about.jpeg';
const CHEF_IMAGE = ROOT . '/img/chef.jpeg';
const GALLERY_IMAGE_1 = ROOT . '/img/gallery1.jpeg';
const GALLERY_IMAGE_2 = ROOT . '/img/gallery2.jpeg';
const GALLERY_IMAGE_3 = ROOT . '/img/gallery3.jpeg';
const GALLERY_IMAGE_4 = ROOT . '/img/gallery4.jpeg';
const HEADER_IMAGE = ROOT . '/img/header.jpeg';
const SPECIALS_IMAGE_1 = ROOT . '/img/specials1.jpeg';
const SPECIALS_IMAGE_2 = ROOT . '/img/specials2.jpeg';
const SPECIALS_IMAGE_3 = ROOT . '/img/specials3.jpeg';

ini_set('error_reporting', E_ALL);

if (DEBUG) {
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
} else {
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
}
