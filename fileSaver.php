<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST["inputPlace"];
    echo "$input";
    $dob = $_POST["dateField"];
    $date = date("Y-m-d H:i:s"); // текущая дата и время

    if (!empty($input)) {
        echo "инпут не пуст";

        // Открываем файл для записи (или создаем, если не существует)
        $file = fopen("journalium.txt", "a");
        echo "$file";
        

        flock($file, 2);
        
        $text = "<p>$input; Дата рождения: $dob; Дата посещения: $date </p>";

        fwrite($file, $text);
        echo "Файл записан";
        flock($file, 3);
        

       	fclose($file);
        echo "Файл закрыт";
    }
}

header("Location: login.php");
exit;
?>
