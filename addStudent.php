<?php
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
$name = $_POST['name'];
$birthYear = date('Y', strtotime($_POST['dateField']));
$gender = $_POST['genderSelect'];
$groupID = $_POST['groupSelect'];
$avgGrade = $_POST['avgGrade'];
$practicePlaceID = $_POST['practicePlace'];

// Вставка данных в таблицу Students
$sql = "INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) 
        VALUES ('$name', '$birthYear', '$gender', '$groupID', '$avgGrade')";

if ($conn->query($sql) === TRUE) {
    // Получение последнего вставленного ID студента
    $studentID = $conn->insert_id;

    // Вставка данных в таблицу StudentPlacement
    $sqlPlacement = "INSERT INTO StudentPlacement (StudentID, PracticePlaceID) 
                     VALUES ('$studentID', '$practicePlaceID')";
    if ($conn->query($sqlPlacement) === TRUE) {
        echo "Новый студент успешно добавлен!";
    } else {
        echo "Ошибка при добавлении данных о месте практики: " . $conn->error;
    }
} else {
    echo "Ошибка при добавлении студента: " . $conn->error;
}

$conn->close();
?>