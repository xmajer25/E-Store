<?php

$host = 'localhost';
$db = 'eStore';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

try{
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
    die();
}

?>