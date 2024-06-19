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

// Проверка авторизации
$authorized = isset($_SESSION['username']);
$groupID = $_SESSION['group'] ?? null;

// Обработка формы поиска
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inputPlace'])) {
    $searchTerm = $_POST['inputPlace'];
    $sql = "SELECT * FROM Students WHERE LastName LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работа с базой данных</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--
     - извлечение
     - добавление
     - изменение
     - удаление 
    -->

    <form action="findStudent.php" method="post">
    <h1>Поиск студентов по имени:</h1>
    <input type="text" name="inputPlace">
    <button>Найти</button>
</form>

    <?php if ($authorized): ?>
        <p>Вы авторизованы как: <?= $_SESSION['username'] ?> | <a href="deauthorization.php">Выйти</a></p>
        <?php if ($groupID == 1): // группа 1 - это администраторы ?>

            <form action="addStudent.php" method="post">
    <h1>Заполните форму для внесения студента:</h1>
    <table>
        <tr> <th>Фамилия</th> <th>Дата рождения</th> <th>Пол</th> <th>Группа</th> <th>Средний балл</th> <th>Место практики</th></tr>
        <tr> 
            <td><input type="text" name="name"></td>
            <td><input type="date" name="dateField"></td> 
            <td><select name="genderSelect">
                <option value="М">М</option>
                <option value="Ж">Ж</option>
            </select></td>
            <td><select name="groupSelect">
                <option value="1">СГУАВТ-23</option>
                <option value="2">СГУАВТ-21</option>
                <option value="3">СГУПМ-13</option>
                <option value="4">СГУПМ-15</option>
                <option value="5">СГУАВТ-25</option>
            </select></td>
            <td><input type="text" name="avgGrade"></td>
            <td><select name="practicePlace">
                <option value="1">Станция по засеву облаков</option>
                <option value="2">Цветочногородская мастерская</option>
                <option value="3">Змеввский песчанный пляж</option>
            </select></td>
    </tr>
    </table>
    <button>Отправить</button>
</form>

<form action="editStudent.php" method="post">
    <h1>Заполните форму для изменения данных студента:</h1>
    <table>
        <tr> <th>ID студента</th> <th>Дата рождения</th> <th>Пол</th> <th>Группа</th> <th>Средний балл</th> <th>Место практики</th></tr>
        <tr> 
            <td><input type="text" name="studentID"></td>
            <td><input type="date" name="dateField"></td> 
            <td><select name="genderSelect">
                <option value="М">М</option>
                <option value="Ж">Ж</option>
            </select></td>
            <td><select name="groupSelect">
                <option value="1">СГУАВТ-23</option>
                <option value="2">СГУАВТ-21</option>
                <option value="3">СГУПМ-13</option>
                <option value="4">СГУПМ-15</option>
                <option value="5">СГУАВТ-25</option>
            </select></td>
            <td><input type="text" name="avgGrade"></td>
            <td><select name="practicePlace">
                <option value="1">Станция по засеву облаков</option>
                <option value="2">Цветочногородская мастерская</option>
                <option value="3">Змеввский песчанный пляж</option>
            </select></td>
    </tr>
    </table>
    <button>Изменить</button>
</form>
<form action="deleteStudent.php" method="post">
    <h1>Удаление студента:</h1>
    <input type="text" name="studentID" placeholder="Введите ID студента" required>
    <button type="submit">Удалить</button>
</form>
        <?php endif; ?>

        <?php else: ?>
        <p>Вы не авторизованы. <a href="authorization.php">Войти</a></p>
    <?php endif; ?>








</body>
</html>


