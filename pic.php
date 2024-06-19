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

// Получаем количество студентов, проходивших практику в каждом месте
$place_counts = array();
$sql = "SELECT PlaceName, COUNT(*) AS count FROM StudentPlacement sp
        LEFT JOIN PracticePlaces pp ON sp.PracticePlaceID = pp.PracticePlaceID
        GROUP BY PlaceName";
$result = $conn->query($sql);

$total_count = 0; // Общее количество студентов на практике
while ($row = $result->fetch_assoc()) {
    $place_counts[$row['PlaceName']] = $row['count'];
    $total_count += $row['count'];
}

$conn->close();

// Создание изображения
$width = 800;
$height = 400;
$im = imagecreatetruecolor($width, $height);

// Цвета для столбцов
$colors = [
    imagecolorallocate($im, 255, 0, 0),    // Красный
    imagecolorallocate($im, 0, 255, 0),    // Зеленый
    imagecolorallocate($im, 0, 0, 255),    // Синий
    imagecolorallocate($im, 255, 255, 0),  // Желтый
];

// Фоновый цвет
$bg_color = imagecolorallocate($im, 240, 240, 240);
imagefilledrectangle($im, 0, 0, $width, $height, $bg_color);

// Размеры прямоугольников и отступы
$margin = 50; // Отступы слева и справа
$bar_height = ($height - 2 * $margin) / count($place_counts); // Высота прямоугольников

$x = $margin; // Начальная позиция X
$y = $margin; // Начальная позиция Y

$color_index = 0;
foreach ($place_counts as $place => $count) {
    $percentage = round(($count / $total_count) * 100);
    $bar_width = ($width - 2 * $margin) * ($percentage / 100);
    $color = $colors[$color_index];

    // Рисуем прямоугольник
    imagefilledrectangle($im, $x, $y, $x + $bar_width, $y + $bar_height, $color);

    // Добавляем текст с процентом
    $text_color = imagecolorallocate($im, 0, 0, 0); // Черный текст
    imagestring($im, 3, $x + 10, $y + $bar_height / 2 - 10, "$percentage%", $text_color);

    // Конвертируем название места практики
    $converted_place = transliterate($place);

    // Добавляем подпись с названием места практики
    imagestring($im, 3, $bar_width + 100, $y + $bar_height / 2, $converted_place, $text_color);

    $y += $bar_height + 10; // Сдвиг на следующий прямоугольник
    $color_index++; // Переключение цвета для следующего столбца
}

// Вывод изображения в формате PNG
header('Content-type: image/png; charset=utf-8');
imagepng($im);
imagedestroy($im);

// Функция для транслитерации
function transliterate($str) {
    $converter = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g',
        'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '',
        'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya', ' ' => '_'
    );
    return strtr(mb_strtolower($str), $converter);
}
?>
