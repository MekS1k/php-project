<?php
$host = "127.0.0.1"; 
$dbname = "db"; 
$username = "root"; 
$passsword = "root"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $passsword);
    $GetUser = $pdo->prepare("SELECT idusers, login, password FROM users WHERE login = ?");
    $sqlGet = "SELECT idUsers, name, secondname, age FROM users";
    $GetData = $pdo->query($sqlGet);
    $users = $GetData->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>