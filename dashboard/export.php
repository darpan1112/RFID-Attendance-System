<?php
require '../config.php';

// Set headers to force file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=attendance_export_' . date('Y-m-d_H-i-s') . '.csv');

// Open output stream
$output = fopen('php://output', 'w');

// CSV header row
fputcsv($output, ['ID', 'UID', 'Name', 'Department', 'Status', 'Timestamp']);

// Fetch attendance data joined with users
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
    ORDER BY a.ts DESC
";

$result = mysqli_query($conn, $query);

// Check query result
if (!$result) {
    fputcsv($output, ['Error fetching data: ' . mysqli_error($conn)]);
    exit;
}

// Write data rows
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['id'],
        $row['card_uid'],
        $row['name'],
        $row['department'],
        ucfirst($row['status']),
        $row['ts']
    ]);
}

// Close file stream
fclose($output);
exit;
?>
