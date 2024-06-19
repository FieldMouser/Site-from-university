<?php
header('Content-Type: text/xml; charset=UTF-8');

$facultyId = $_GET['faculty'];
$mysqli = new mysqli('localhost', 'user101', 'gun_fedora_user_101', 'user101');
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql = "SELECT GroupNumber FROM Groups WHERE FacultyID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $facultyId);
$stmt->execute();
$result = $stmt->get_result();

$xml = new SimpleXMLElement('<groups/>');

while ($row = $result->fetch_assoc()) {
    $group = $xml->addChild('group', $row['GroupNumber']);
}

echo $xml->asXML();

$stmt->close();
$mysqli->close();
?>
