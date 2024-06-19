<?php include 'track_visit.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница входа</title>
</head>
<body BGCOLOR="#011F26" TEXT="#03A688">
    <center>
    <?php
    $date = isset($_COOKIE['selectedDate']) ? $_COOKIE['selectedDate'] : '';
    if (!empty($date)) {
        list($input, $dob, $date) = explode(":", $date);
        echo "Ваше имя: $input; Дата рождения: $dob; Дата и время регистрации: $date<br>";
        
}
    else {
echo "Пройдите регистрацию пользователя:<br>";
}
    ?>
    
    <form action="cookie.php" method="post">
        Имя пользователя:
        <input type="text" name="inputPlace" title="Введите имя пользователя">
        <br>
        Дата рождения:
        <input type="date" name="dateField" id="dateID">
        <br>
        <button type="submit">Отправить</button>
    </form>

    
        <img src="https://media.tenor.com/Rc-kmfcCUnIAAAAi/rainbow-stickman.gif" alt="dancing stickman">
    </center>
    
    <form action="fileSaver.php" method="post">
        <input type="hidden" name="inputPlace" value="<?= $input?>">
        <input type="hidden" name="dateField" value="<?= $dob?>">
        Также вы можете отметить ваше посещение в журнале
        <br>
        <button type="submit">Отметиться</button>
        <br>
        <a href="journal.php">Показать записи в файле</a>

    </form>
</body>
</html>