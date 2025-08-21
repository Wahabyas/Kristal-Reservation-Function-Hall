<?php
require '../model/config/connection2.php';

// Fetch dates with both Morning and After Noon booked
$query1 = "
    SELECT date 
    FROM events
    WHERE Status = 'Approved' AND Duration IN ('Morning', 'After Noon')
    GROUP BY date
    HAVING COUNT(DISTINCT Duration) = 2
";

$result1 = mysqli_query($conn, $query1);
$disabledDates = [];

while ($row = mysqli_fetch_assoc($result1)) {
    $disabledDates[] = $row['date'];
}


$query2 = "
    SELECT date 
    FROM events 
    WHERE Status = 'Approved' AND Duration = 'Whole Day'
";

$result2 = mysqli_query($conn, $query2);

while ($row = mysqli_fetch_assoc($result2)) {
    $disabledDates[] = $row['date'];
}


$disabledDates = array_unique($disabledDates);


echo json_encode(['dates' => array_values($disabledDates)]);
?>
