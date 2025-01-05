<?php
require 'db.php';

function addUsers($pdo, $login, $password, $name, $secondname, $age) {
    try {
        $sqlAdd = "INSERT INTO `users` (`login`, `password`, `name`, `secondname`, `age`) VALUES (?, ?, ?, ?, ?)";
        $AddData = $pdo->prepare($sqlAdd);
        $AddData->execute([$login, $password, $name, $secondname, $age]);
    } catch (PDOException $e) {
        die("Ошибка добавления пользователя: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add']) && $_POST['add'] === 'addUser') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $secondname = $_POST['secondname'] ?? '';
    $age = $_POST['age'] ?? 0;

    addUsers($pdo, $login, $password, $name, $secondname, (int)$age);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Регистрация</title>
</head>
<body>
  <form method="POST">
    <div>
      <input type="text" name="login" placeholder="Введите логин" required>
      <input type="password" name="password" placeholder="Введите пароль" required>
    </div>
    <div>
      <input type="text" name="name" placeholder="Введите имя" required>
      <input type="text" name="secondname" placeholder="Введите фамилию" required>
      <input type="number" name="age" placeholder="Введите возраст" required>
    </div>
    <button type="submit" name="add" value="addUser">Добавить</button>
  </form>
</body>
</html>