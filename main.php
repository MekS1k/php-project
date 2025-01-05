<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = $_POST['login'];
  $password = $_POST['password'];

  try {
     
    $GetUser->execute([$login]);
    $user = $GetUser->fetch(PDO::FETCH_ASSOC);
      if ($password== $user['password']) {
          $_SESSION['user_id'] = $user['idusers'];
          $_SESSION['user_login'] = $user['login'];

          header("Location: enter.php");
          exit();
      } else {
          $error = "Неверный логин или пароль";
      }
  } catch (PDOException $e) {
      die("Ошибка входа: " . $e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Вход</title>
</head>
<body>
<h1>Вход</h1>
<form method="POST" action="">
  <div>
    <input type="text" name="login" placeholder="Логин" required>
  </div>
  <div>
    <input type="password" name="password" placeholder="Пароль" required>
  </div>
  <button type="submit">Войти</button>
</form>
<?php if (isset($error)): ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<button onclick="location.href='reg.php'">Регистрация</button>
</body>
</html>