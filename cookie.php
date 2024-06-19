<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST["inputPlace"];
    $dob = $_POST["dateField"];
    $date = date("Y-m-d H-i-s"); // текущая дата и время
    $time = time();

    // Устанавливаем cookie с временем жизни 1 час
    $selectedDate = "$input:$dob:$date";
    setcookie("selectedDate", $selectedDate, time() + 3600, "/");
}

// Перенаправляем пользователя обратно на страницу выбора уведомления
header("Location: login.php");
exit;
?>
