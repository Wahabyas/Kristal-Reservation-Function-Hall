<?php
require '../model/config/connection2.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Validate the date format (YYYY-MM-DD)
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    if (!$dateObj || $dateObj->format('Y-m-d') !== $date) {
        echo json_encode(['error' => 'Invalid date format']);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT Duration FROM events WHERE `date` = ? AND `Status` = 'Approved'");
    if (!$stmt) {
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit;
    }

    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        echo json_encode(['error' => 'Failed to execute query']);
        exit;
    }

    $durations = [];
    while ($row = $result->fetch_assoc()) {
        $durations[] = $row['Duration'];
    }

    echo json_encode(['durations' => $durations]);
} else {
    echo json_encode(['error' => 'Date parameter is missing']);
}
?>
