<?php

require_once 'init.php';

if (isset($_POST)) {
    // no need to use regex or any validation for XSS or SQL injection because htmlspecialchars does the work
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $msg = htmlspecialchars($_POST['message']);

    // make database connection
    $database = new Database(DB, DB_USER, DB_PASS);
    $pdo = $database->getPdo();

    $stmt = $pdo->prepare("INSERT INTO contact (name, email, msg) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->execute([$name, $email, $msg]);
    }

    header("Location: ./index.php");
}

