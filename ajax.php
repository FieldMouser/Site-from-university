<?php include 'track_visit.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>AJAX XML</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <select id="faculty" onchange="updateGroups()">
        <option value="">Выберите факультет</option>
        <?php
        $mysqli = mysqli_connect('localhost', 'user101', 'gun_fedora_user_101', 'user101');
        if (!$mysqli) { echo "Can't connect to database!"; exit; }
        $SQL = "SELECT FacultyID, FacultyName FROM Faculties;";
        $result = mysqli_query($mysqli, $SQL);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['FacultyID'] . '">' . $row['FacultyName'] . '</option>';
        }
        ?>
    </select>

    <select id="groups">
        <option>Пока пусто</option>
    </select>

    <form method="post">
        <input type="submit" value="Ок">
    </form>

<script>
    function updateGroups() {
        var selectedFaculty = $("#faculty").val();
        $.ajax({
            url: 'getGroups.php?faculty=' + encodeURIComponent(selectedFaculty),
            dataType: 'xml',
            success: function(data) {
                var groupsList = '<option>Выберите группу</option>';
                $(data).find('group').each(function() {
                    groupsList += '<option>' + $(this).text() + '</option>';
                });
                $('#groups').html(groupsList);
            }
        });
    }
</script>

</body>
</html>
