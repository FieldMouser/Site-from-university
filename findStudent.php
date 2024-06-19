<?php

session_start();

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

// Обработка формы поиска
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inputPlace'])) {
    $searchTerm = $_POST['inputPlace'];
    $sql = "SELECT s.StudentID, s.LastName, s.BirthYear, s.Gender, g.GroupNumber AS `Group`, f.FacultyName, s.AverageGrade, pp.PlaceName, pp.City
            FROM Students s
            LEFT JOIN Groups g ON s.GroupID = g.GroupID
            LEFT JOIN Faculties f ON g.FacultyID = f.FacultyID
            LEFT JOIN StudentPlacement sp ON s.StudentID = sp.StudentID
            LEFT JOIN PracticePlaces pp ON sp.PracticePlaceID = pp.PracticePlaceID
            WHERE s.LastName LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск студентов</title>
</head>
<body>
    <h1>Поиск студентов по имени:</h1>
    <form action="findStudent.php" method="post">
        <input type="text" name="inputPlace" placeholder="Введите фамилию">
        <button type="submit">Найти</button>
    </form>

    <?php
    if (isset($result) && $result->num_rows > 0) {
        echo "<h2>Результаты поиска:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Фамилия</th><th>Год рождения</th><th>Пол</th><th>Группа</th><th>Факультет</th><th>Средний балл</th><th>Место практики</th><th>Город</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['StudentID']}</td>
                    <td>{$row['LastName']}</td>
                    <td>{$row['BirthYear']}</td>
                    <td>{$row['Gender']}</td>
                    <td>{$row['Group']}</td>
                    <td>{$row['FacultyName']}</td>
                    <td>{$row['AverageGrade']}</td>
                    <td>{$row['PlaceName']}</td>
                    <td>{$row['City']}</td>
                  </tr>";
        }
        echo "</table>";
    } elseif (isset($result)) {
        echo "<p>Ни одного студента не найдено.</p>";
    }
    ?>
</body>
</html>
