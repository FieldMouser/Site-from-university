<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "user101";
$password = "gun_fedora_user_101";
$dbname = "user101";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE UserName = '$userName' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $userName;
        $_SESSION['group'] = $user['GroupID'];
        header("Location: DBEdit.php");
    } else {
        echo "Неверные данные пользователя";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <form action="authorization.php" method="post">
        <h1>Авторизация</h1>
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
