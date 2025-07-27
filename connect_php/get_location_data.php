<?php
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$database = "safeway";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}
$conn->set_charset("utf8mb4");

$input = $_GET['location'] ?? '';
$location = strtolower(trim($input));

$stmt = $conn->prepare("SELECT * FROM locations WHERE LOWER(area_name) = ?");
$stmt->bind_param("s", $location);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "safety_score" => $row["safety_score"] ?? "N/A",
        "hospitals" => $row["hospitals"] ?? "",
        "police_stations" => $row["police_stations"] ?? "",
        "crime_trend" => $row["crime_trend"] ?? "Unknown"
    ]);
} else {
    echo json_encode(["error" => "No data found"]);
}

$stmt->close();
$conn->close();
?>
