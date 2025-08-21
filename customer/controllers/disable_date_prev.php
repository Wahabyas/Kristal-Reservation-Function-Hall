<?php
require '../model/config/connection2.php';

$today = date('Y-m-d');
$query3 = "
    SELECT '$today' as date
    UNION
    SELECT DATE_SUB('$today', INTERVAL n DAY) as date
    FROM (
        SELECT a.N + b.N * 10 AS n
        FROM 
            (SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) a,
            (SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) b
        ORDER BY n
    ) numbers
    WHERE DATE_SUB('$today', INTERVAL n DAY) >= (SELECT MIN(date) FROM events)
";
$result3 = mysqli_query($conn, $query3);

while ($row = mysqli_fetch_assoc($result3)) {
    $disabledDates[] = $row['date'];
}

$disabledDates = array_unique($disabledDates);

echo json_encode(['datesa' => array_values($disabledDates)]);

?>
