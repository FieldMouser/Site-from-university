<?php
$mysqli = new mysqli('localhost', 'user101', 'gun_fedora_user_101', 'user101');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Обработка посещений
$pageName = basename($_SERVER['PHP_SELF']); // Получаем только имя файла без полного пути
$visitDate = date('Y-m-d H:i:s'); // Текущая дата и время

// Проверяем, есть ли уже запись для текущей страницы
$stmt = $mysqli->prepare("SELECT id, visit_count FROM page_visits WHERE page_name = ?");
$stmt->bind_param("s", $pageName);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Если запись уже есть - обновляем счетчик и дату последнего посещения
    $stmt->bind_result($id, $visitCount);
    $stmt->fetch();
    $visitCount++;

    $updateStmt = $mysqli->prepare("UPDATE page_visits SET visit_count = ?, last_visit = ?, visit_date = ? WHERE id = ?");
    $updateStmt->bind_param("issi", $visitCount, $visitDate, $visitDate, $id);
    $updateStmt->execute();
    $updateStmt->close();
} else {
    // Если записи нет - создаем новую запись
    $insertStmt = $mysqli->prepare("INSERT INTO page_visits (page_name, visit_count, last_visit, visit_date) VALUES (?, 1, ?, ?)");
    $insertStmt->bind_param("sss", $pageName, $visitDate, $visitDate);
    $insertStmt->execute();
    $insertStmt->close();
}

$stmt->close();
$mysqli->close();
?>
