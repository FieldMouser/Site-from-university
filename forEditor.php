<?php
session_start();

// Проверка на совпадение CAPTCHA
if ($_SESSION['captcha_keystring'] != $_POST['captcha']) {
    // Если капча неверна, перенаправляем обратно с сообщением об ошибке
    header("Location: L6.php?error=captcha");
    exit;
}

// Получение данных из CKEditor
$text = $_POST['editor'];

// Путь к файлу для сохранения записей
$file = 'journalEditor.txt';

// Открытие файла для записи (режим "дозаписи")
$handle = fopen($file, 'a');
if (!$handle) {
    die("Не удалось открыть файл для записи.");
}

// Получение текущей даты и времени
$date = date('Y-m-d H:i:s');

// Форматирование строки для записи в файл
$content = "Дата: $date\nТекст записи:\n$text\n\n";

// Запись данных в файл
if (fwrite($handle, $content) === FALSE) {
    die("Не удалось записать данные в файл.");
}

// Закрытие файла
fclose($handle);

// Вывод сообщения об успешной отправке формы
echo "<h2>Форма успешно отправлена!</h2>";

// Вывод всех данных из файла
echo "<h2>Все записи:</h2>";

// Проверка наличия файла
if (file_exists($file)) {
    // Чтение содержимого файла и вывод на экран
    $data = file_get_contents($file);
    echo nl2br($data);
} else {
    echo "Файл $file не найден!";
}
echo "<form method='post' action='L6.php'>";
echo "<input type='submit' value='НАЗАД'>";
echo "</form>";
?>
