<?php include 'track_visit.php'; ?>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor и CAPTCHA</title>
    <!-- Подключаем CKEditor -->
    <script src="ckeditor/ckeditor.js"></script>
</head>
<body>
    <h2>Форма ввода текста с CKEditor и проверкой CAPTCHA</h2>
    <form action="forEditor.php" method="post">
        <!-- Поле для ввода текста с CKEditor -->
        <textarea name="editor" id="editor"></textarea>
        <br>
        <!-- Отображение изображения CAPTCHA -->
        <p><img src="kcaptcha/index.php?<?php echo session_name(); ?>=<?php echo session_id(); ?>"></p>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'captcha') {
            echo "<p style='color: red;'>Каптча введена неверно!</p>";
        }
        ?>
        <!-- Поле для ввода CAPTCHA -->
        <label for="captcha">Введите CAPTCHA:</label>
        <input type="text" id="captcha" name="captcha" required>
        <br>
        <!-- Кнопка отправки формы -->
        <button type="submit">Отправить</button>
    </form>

    <!-- Инициализация CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>
