<?php
$host = "127.0.0.1"; 
$dbname = "db"; 
$username = "root"; 
$passsword = "root"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $passsword);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}