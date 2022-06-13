<?php

require_once '../init.php';

$database = new Database(DB, DB_USER, DB_PASS);
$fetcher = new DatabaseFetcher($database);
$inserter = new DatabaseInserter($database);
$updater = new DatabaseUpdater($database);
$deleter = new DatabaseDeleter($database);

$fetcher->user();
$fetcher->menus();
$fetcher->contact();
$fetcher->todo();

$user = $database->getUser();
$menus = $database->getMenus();
$contacts = $database->getContact();
$todo = $database->getTodo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel | <?= $_GET['page'] ?? null?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-blue">
