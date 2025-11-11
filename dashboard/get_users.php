<?php
require '../config.php';
header('Content-Type: application/json');

$query = "SELECT id, card_uid, name, department FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);
?>
