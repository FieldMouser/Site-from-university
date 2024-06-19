<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал посетителей</title>
</head>
<body BGCOLOR="#011F26" TEXT="#03A688">
<h1>Записи посетителей</h1>
    <?php
    // Читаем содержимое файла с уведомлениями
    $fileContent = file_get_contents('journalium.txt');
    echo "$fileContent";
    ?>

</body>
</html>