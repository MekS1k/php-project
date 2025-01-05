<?php
require 'db.php';

try {
    // SQL-запрос для получения всех данных из таблицы
    $sqlGet = "SELECT idUsers, name, secondname, age FROM users";
    $GetData = $pdo->query($sqlGet);
    // Получение данных в виде массива
    $users = $GetData->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Ошибка выполнения запроса: " . $e->getMessage());
}

function addUsers($pdo, $login, $password, $name, $secondname, $age) {
    try {
        $sqlAdd = "INSERT INTO `users` (`login`, `password`, `name`, `secondname`, `age`) VALUES (?, ?, ?, ?, ?)";
        $AddData = $pdo->prepare($sqlAdd);
        $AddData->execute([$login, $password, $name, $secondname, $age]);
    } catch (PDOException $e) {
        die("Ошибка добавления пользователя: " . $e->getMessage());
    }
}

// Обрабатываем запрос POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test']) && $_POST['test'] === 'runFunction') {
    addUsers($pdo, "a", "a", "a", "a", 22);

    // Перенаправляем на ту же страницу
    header("Location: " . $_SERVER['PHP_SELF']);
    exit(); // Завершаем выполнение скрипта
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
  <div>
    <input type="text" placeholder="введите логин">
    <input type="text"placeholder="введите пароль">
  </div>
<form method="POST">
    <button type="submit" name="test" id="test" value="runFunction">Добавить</button>
</form>