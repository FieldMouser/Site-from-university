<?php include 'track_visit.php'; ?>

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

// SQL-запрос для получения данных
$sql = "SELECT s.StudentID, s.LastName, s.BirthYear, s.Gender, g.GroupNumber AS `Group`, f.FacultyName, s.AverageGrade, pp.PlaceName, pp.City
        FROM Students s
        LEFT JOIN Groups g ON s.GroupID = g.GroupID
        LEFT JOIN Faculties f ON g.FacultyID = f.FacultyID
        LEFT JOIN StudentPlacement sp ON s.StudentID = sp.StudentID
        LEFT JOIN PracticePlaces pp ON sp.PracticePlaceID = pp.PracticePlaceID";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список студентов</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Список студентов</h1>
    
    <table>
        <tr>
            <th>StudentID</th>
            <th>LastName</th>
            <th>BirthYear</th>
            <th>Gender</th>
            <th>Group</th>
            <th>FacultyName</th>
            <th>AverageGrade</th>
            <th>PlaceName</th>
            <th>City</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
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
        } else {
            echo "<tr><td colspan='9'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <h2>Диаграмма:</h2>
    <div class="chart-container">
        <img src="pic.php" alt="График" border = "2">
    </div>

</body>
</html>
