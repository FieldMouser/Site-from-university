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
$name = $_POST['name'];
$birthYear = date('Y', strtotime($_POST['dateField']));
$gender = $_POST['genderSelect'];
$groupID = $_POST['groupSelect'];
$avgGrade = $_POST['avgGrade'];
$practicePlaceID = $_POST['practicePlace'];

// Обновление данных в таблице Students
$sql = "UPDATE Students 
        SET BirthYear = '$birthYear', Gender = '$gender', GroupID = '$groupID', AverageGrade = '$avgGrade'
        WHERE StudentID = '$studentID'";

if ($conn->query($sql) === TRUE) {
    // Обновление данных в таблице StudentPlacement
    $sqlPlacement = "UPDATE StudentPlacement 
                     SET PracticePlaceID = '$practicePlaceID' 
                     WHERE StudentID = '$studentID'";
    if ($conn->query($sqlPlacement) === TRUE) {
        echo "Данные студента успешно обновлены!";
    } else {
        echo "Ошибка при обновлении данных о месте практики: " . $conn->error;
    }
} else {
    echo "Ошибка при обновлении данных студента: " . $conn->error;
}

$conn->close();
?>
