<?php
require '../config.php';
header('Content-Type: application/json');

// ✅ Fetch today's attendance using JOIN on user_id
$query = "
    SELECT 
        a.id,
        u.card_uid,
        u.name,
        u.department,
        a.status,
        a.ts
    FROM attendance a
    JOIN users u ON a.user_id = u.id
    WHERE DATE(a.ts) = CURDATE()
    ORDER BY a.id DESC
";

$result = mysqli_query($conn, $query);
$data = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
