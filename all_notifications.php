<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$conn = new mysqli("localhost", "root", "", "safeway");
if ($conn->connect_error) {
  die("DB connection failed");
}

$sql = "SELECT title, message, location, category, urgency, link, timestamp FROM notifications ORDER BY timestamp DESC";
$result = $conn->query($sql);

$notifications = [];
$categoryCount = [];
$urgencyCount = [];
$timeCount = [];
$locationCount = [];

while ($row = $result->fetch_assoc()) {
  $notifications[] = $row;

  $category = $row['category'];
  $categoryCount[$category] = ($categoryCount[$category] ?? 0) + 1;

  $urgency = $row['urgency'];
  $urgencyCount[$urgency] = ($urgencyCount[$urgency] ?? 0) + 1;

  $timeKey = date("Y-m-d", strtotime($row['timestamp']));
  $timeCount[$timeKey] = ($timeCount[$timeKey] ?? 0) + 1;

  $location = $row['location'];
  $locationCount[$location] = ($locationCount[$location] ?? 0) + 1;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Notifications - SafeWay</title>



  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Google Font & AdminLTE CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
<link rel="stylesheet" href="dist/css/adminlte.min.css" />
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
 
 
 
 <style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
    }

    .content-wrapper {
      padding: 30px;
      
    }

    h1 {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    p {
      font-size: 1rem;
      margin-bottom: 20px;
      color: #555;
    }

    .chart-container {
      height: 320px;
      padding: 10px;
      margin-bottom: 30px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease-in-out;
    }

    .chart-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .center-chart-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 100%;
    }

    .center-chart-content canvas {
      max-width: 100%;
      height: auto;
    }

    .table-responsive {
      background: #fff;
      padding: 15px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #6c5ce7;
      color: white;
    }

    thead th {
      padding: 12px;
      text-align: left;
      font-size: 0.95rem;
    }

    tbody td {
      padding: 12px;
      font-size: 0.95rem;
      border-bottom: 1px solid #eee;
    }

    tbody tr:hover {
      background-color: #f0f0f0;
    }

    td a {
      color: #0984e3;
      text-decoration: none;
      font-weight: 500;
    }

    td a:hover {
      text-decoration: underline;
    }

    .badge {
      display: inline-block;
      padding: 6px 12px;
      font-size: 0.8rem;
      font-weight: 600;
      border-radius: 20px;
      text-transform: capitalize;
      color: white;
    }

    .badge-danger { background: #d63031; }
    .badge-warning { background: #fdcb6e; color: #333; }
    .badge-info { background: #00cec9; }
    .badge-secondary { background: #b2bec3; }



    .nav-sidebar .nav-link p {
  color:rgb(221, 210, 210); /* off-white, gentle on eyes */
}







    
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Home</a></li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" />
      <span class="brand-text font-weight-light">SafeWay</span>
    </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
        <li class="nav-item"><a href="location_search.php" class="nav-link"><i class="nav-icon fas fa-search-location"></i><p>Basic Location Search</p></a></li>
        <li class="nav-item"><a href="map_explore.php" class="nav-link"><i class="nav-icon fas fa-map-marked-alt"></i><p>Map Exploration</p></a></li>
        <li class="nav-item"><a href="safety_ratings.php" class="nav-link"><i class="nav-icon fas fa-eye"></i><p>Visual Safety Ratings</p></a></li>
        <li class="nav-item"><a href="check_safety.php" class="nav-link"><i class="nav-icon fas fa-shield-alt"></i><p>Check Before Going Out</p></a></li>
        <li class="nav-item"><a href="identify_routes.php" class="nav-link"><i class="nav-icon fas fa-route"></i><p>Identify Safer Routes</p></a></li>
        <li class="nav-item"><a href="filter_incidents.php" class="nav-link"><i class="nav-icon fas fa-filter"></i><p>Filter Incidents</p></a></li>
        <li class="nav-item"><a href="crime_hotspot.php" class="nav-link"><i class="nav-icon fas fa-exclamation-triangle"></i><p>Crime Hotspot Tracker</p></a></li>
        <li class="nav-item"><a href="community_resources.php" class="nav-link"><i class="nav-icon fas fa-hands-helping"></i><p>Community Resources</p></a></li>
        <li class="nav-item"><a href="understand_factors.php" class="nav-link"><i class="nav-icon fas fa-lightbulb"></i><p>Understanding Safety Factors</p></a></li>
        <li class="nav-item"><a href="legend_info.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Using the Legend</p></a></li>
        <li class="nav-item"><a href="send_notifications.php" class="nav-link"><i class="nav-icon fas fa-bell"></i><p>Send Notifications</p></a></li>
        <li class="nav-item"><a href="all_notifications.php" class="nav-link active"><i class="nav-icon fas fa-bell"></i><p>All Notifications</p></a></li>
        <li class="nav-item"><a href="emergency_calls.php" class="nav-link"><i class="nav-icon fas fa-phone-alt"></i><p>Emergency Calls</p></a></li>
        <li class="nav-item"><a href="login.html" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
      </ul>
    </nav>
  </div>
</aside>







  <div class="content-wrapper">
    <h1>All Notifications</h1>
    <p>Browse all safety notifications submitted by all users.</p>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="chart-container">
            <div class="center-chart-content">
              <canvas id="categoryChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart-container">
            <div class="center-chart-content">
              <canvas id="urgencyChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart-container">
            <div class="center-chart-content">
              <canvas id="timeChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart-container">
            <div class="center-chart-content">
              <canvas id="locationChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive mt-4">
      <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Location</th>
            <th>Category</th>
            <th>Urgency</th>
            <th>Link</th>
            <th>Sent At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (empty($notifications)) {
            echo "<tr><td colspan='7'>No notifications available.</td></tr>";
          } else {
            foreach ($notifications as $row) {
              $urgencyClass = match($row['urgency']) {
                'critical' => 'danger',
                'high' => 'warning',
                'medium' => 'info',
                default => 'secondary',
              };
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['title']) . "</td>";
              echo "<td>" . htmlspecialchars($row['message']) . "</td>";
              echo "<td>" . htmlspecialchars($row['location']) . "</td>";
              echo "<td>" . ucfirst(htmlspecialchars($row['category'])) . "</td>";
              echo "<td><span class='badge badge-$urgencyClass'>" . ucfirst(htmlspecialchars($row['urgency'])) . "</span></td>";
              echo "<td>" . ($row['link'] ? "<a href='" . htmlspecialchars($row['link']) . "' target='_blank'>Link</a>" : "-") . "</td>";
              echo "<td>" . date("M d, Y h:i A", strtotime($row['timestamp'])) . "</td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const categoryData = <?php echo json_encode($categoryCount); ?>;
  const urgencyData = <?php echo json_encode($urgencyCount); ?>;
  const timeData = <?php echo json_encode($timeCount); ?>;
  const locationData = <?php echo json_encode($locationCount); ?>;

  const colors = ['#6c5ce7', '#00cec9', '#fdcb6e', '#d63031', '#636e72'];

  new Chart(document.getElementById('categoryChart'), {
    type: 'bar',
    data: {
      labels: Object.keys(categoryData),
      datasets: [{
        label: 'Category Count',
        data: Object.values(categoryData),
        backgroundColor: colors,
      }]
    },
    options: {
      responsive: true,
      plugins: { title: { display: true, text: 'Notification Categories' } }
    }
  });

  new Chart(document.getElementById('urgencyChart'), {
    type: 'doughnut',
    data: {
      labels: Object.keys(urgencyData),
      datasets: [{
        label: 'Urgency Levels',
        data: Object.values(urgencyData),
        backgroundColor: colors,
      }]
    },
    options: {
      responsive: true,
      plugins: { title: { display: true, text: 'Urgency Breakdown' } }
    }
  });

  new Chart(document.getElementById('timeChart'), {
    type: 'line',
    data: {
      labels: Object.keys(timeData),
      datasets: [{
        label: 'Notifications per Day',
        data: Object.values(timeData),
        fill: false,
        borderColor: '#0984e3',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: { title: { display: true, text: 'Notifications Over Time' } }
    }
  });

  new Chart(document.getElementById('locationChart'), {
    type: 'bar',
    data: {
      labels: Object.keys(locationData),
      datasets: [{
        label: 'Location Count',
        data: Object.values(locationData),
        backgroundColor: '#74b9ff'
      }]
    },
    options: {
      responsive: true,
      indexAxis: 'y',
      plugins: { title: { display: true, text: 'Top Locations Reported' } }
    }
  });
</script>
</body>
</html>
