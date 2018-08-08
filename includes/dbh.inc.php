<?php

$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'blog_database';

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $dbh = new PDO('mysql:host=localhost;dbname=blog_database', $dbUsername, $dbPassword);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
