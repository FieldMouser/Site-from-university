<?php
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

// Получение данных из формы
$studentID = $_POST['studentID'];

// Удаление данных из таблицы StudentPlacement
$sqlPlacement = "DELETE FROM StudentPlacement WHERE StudentID = '$studentID'";
if ($conn->query($sqlPlacement) === TRUE) {
    // Удаление данных из таблицы Students
    $sql = "DELETE FROM Students WHERE StudentID = '$studentID'";
    if ($conn->query($sql) === TRUE) {
        echo "Студент успешно удален!";
    } else {
        echo "Ошибка при удалении студента: " . $conn->error;
    }
} else {
    echo "Ошибка при удалении данных о месте практики: " . $conn->error;
}

$conn->close();
?>
