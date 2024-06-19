<?php include 'track_visit.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница входа</title>
    <style>
        .error-message {
            color: blue;
            font-style: italic;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#registrationForm").validate({
                rules: {
                    inputPlace: {
                        required: true,
                        minlength: 2
                    },
                    dateField: {
                        required: true,
                        dateISO: true
                    }
                },
                messages: {
                    inputPlace: {
                        required: "Пожалуйста, введите имя пользователя",
                        minlength: "Имя пользователя должно содержать не менее 2 символов"
                    },
                    dateField: {
                        required: "Пожалуйста, введите дату рождения",
                        dateISO: "Пожалуйста, введите корректную дату в формате ГГГГ-ММ-ДД"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                    error.addClass("error-message"); // Добавляем класс error-message к сообщениям об ошибках
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    var inputPlace = $('#inputPlace').val();
                    var dateField = $('#dateID').val();

                    var myWin1 = window.open("", "TestWindow", "width=500, height=400, status=no, toolbar=no, resizable=yes, scrollbars=no, menubar=no");
                    myWin1.document.write("<form id='popupForm' action='cookie.php' method='post'>");
                    myWin1.document.write("<label for='inputPlace_popup'>Имя пользователя:</label>");
                    myWin1.document.write("<input type='text' id='inputPlace_popup' name='inputPlace' value='" + inputPlace + "' required>");
                    myWin1.document.write("<br>");
                    myWin1.document.write("<label for='dateID_popup'>Дата рождения:</label>");
                    myWin1.document.write("<input type='date' id='dateID_popup' name='dateField' value='" + dateField + "' required>");
                    myWin1.document.write("<br>");
                    myWin1.document.write("<br><br>");
                    myWin1.document.write("<input type='submit' value='Отправить'>");
                    myWin1.document.write("<br><br>");
                    myWin1.document.write("<input type='button' value='Закрыть' onclick='self.close();'>");
                    myWin1.document.write("</form>");
                }
            });
        });
    </script>
</head>
<body BGCOLOR="#011F26" TEXT="#03A688">
    <center>
        <?php
        $date = isset($_COOKIE['selectedDate']) ? $_COOKIE['selectedDate'] : '';
        if (!empty($date)) {
            list($input, $dob, $date) = explode(":", $date);
            echo "Ваше имя: $input; Дата рождения: $dob; Дата и время регистрации: $date<br>";
        } else {
            echo "Пройдите регистрацию пользователя:<br>";
        }
        ?>
        
        <form id="registrationForm" name="registrationForm" action="cookie.php" method="post">
            Имя пользователя:
            <input type="text" name="inputPlace" id="inputPlace" title="Введите имя пользователя">
            <br>
            Дата рождения:
            <input type="date" name="dateField" id="dateID">
            <br>
            <button type="submit">Отправить</button>
        </form>

        <img src="https://media.tenor.com/Rc-kmfcCUnIAAAAi/rainbow-stickman.gif" alt="dancing stickman">
    </center>
    
    <form action="fileSaver.php" method="post">
        <input type="hidden" name="inputPlace" value="<?= isset($input) ? $input : '' ?>">
        <input type="hidden" name="dateField" value="<?= isset($dob) ? $dob : '' ?>">
        Также вы можете отметить ваше посещение в журнале
        <br>
        <button type="submit">Отметиться</button>
        <br>
        <a href="journal.php">Показать записи в файле</a>
    </form>
</body>
</html>
