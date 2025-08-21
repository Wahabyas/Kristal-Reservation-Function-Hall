<?php
require '../model/config/connection2.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    $stmt = $conn->prepare("SELECT Duration FROM events WHERE date = ? AND `Status` = 'Approved'");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $durations = [];
    while ($row = $result->fetch_assoc()) {
        $durations[] = $row['Duration'];
    }

    echo json_encode(['durations' => $durations]);
}
?>
 