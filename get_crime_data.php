<?php
header('Content-Type: application/json');
$host = 'localhost';
$dbname = 'safeway';
$user = 'root';
$pass = '';

// Connect to MySQL database
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get the days parameter from query string
$days = isset($_GET['days']) ? (int)$_GET['days'] : 30;  // Default 30 days
if ($days <= 0) $days = 30;

// Calculate cutoff date
$cutoff_date = date('Y-m-d', strtotime("-$days days"));

// Query to get all incidents in the date range
$sql = "SELECT area, latitude as lat, longitude as lon, incident_count as count, incident_date as date
        FROM crime_incidents
        WHERE incident_date >= ?
        ORDER BY incident_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $cutoff_date);
$stmt->execute();

$result = $stmt->get_result();
$crimeData = [];

while ($row = $result->fetch_assoc()) {
    $crimeData[] = $row;
}

$stmt->close();
$conn->close();

// Return JSON response
echo json_encode(['data' => $crimeData]);
?>
