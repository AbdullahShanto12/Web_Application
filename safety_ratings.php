<?php
include 'connect.php';

// Total Resources (rows in safety_ratings)
$totalSql = "SELECT * FROM safety_ratings";
$totalRes = $conn->query($totalSql);

// Unique Categories (assuming area_type is a category)
$categoriesSql = "SELECT DISTINCT area_type FROM safety_ratings";
$categoriesRes = $conn->query($categoriesSql);

// Distinct Areas (based on location)
$locationsSql = "SELECT DISTINCT location FROM safety_ratings";
$locationsRes = $conn->query($locationsSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Visual Safety Ratings - SafeWay</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <!-- Custom CSS -->
  <style>
  /* Base body */
  body {
    background: linear-gradient(135deg, #e0f0ff 0%, #ffffff 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #223344;
  }

  /* Navbar */
  .main-header.navbar {
    background: #004085;
    color: white;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0, 64, 133, 0.3);
  }

  .main-header.navbar .nav-link,
  .main-header.navbar .nav-icon {
    color: #cce0ff;
    transition: color 0.3s ease;
  }

  .main-header.navbar .nav-link:hover {
    color: #ffffff;
  }

  /* Sidebar */
  .main-sidebar {
    background-color: rgb(28, 31, 34);
    color: #ffffff;
  }

  .main-sidebar .brand-link {
    background-color: rgb(34, 38, 43);
    color: #ffffff;
    font-weight: bold;
    border-bottom: 1px solid #003366;
  }

  .main-sidebar .nav-link {
    color: #cfd9ff;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .main-sidebar .nav-link .nav-icon {
    color: #a0b8ff;
  }

  .main-sidebar .nav-link.active,
  .main-sidebar .nav-link:hover {
    background-color: #e6f0ff;
    color: #001f3f;
    font-weight: bold;
    border-radius: 8px;
  }

  .main-sidebar .nav-link.active .nav-icon,
  .main-sidebar .nav-link:hover .nav-icon {
    color: #001f3f;
  }

  /* Content Wrapper */
  .content-wrapper {
    background: #fdfefe;
    padding: 40px 35px 60px;
    min-height: calc(100vh - 56px);
  }

  /* Headings */
  h3, h5 {
    border-bottom: 4px solid #0056b3;
    padding-bottom: 12px;
    margin-bottom: 30px;
    font-weight: 800;
    color: #003366;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  /* Card */
  .card {
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    border: none;
  }

  .card .card-body {
    padding: 2rem;
  }

  /* Stats Cards */
  .stats-card {
    text-align: center;
    padding: 20px;
    border-radius: 15px;
    color: white;
    font-weight: bold;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    transition: transform 0.2s ease;
  }
  .stats-card:hover {
    transform: translateY(-5px);
  }

  .bg-info {
    background-color:rgb(31, 191, 219) !important; /* Stronger royal blue */
  color: #FFFFFF !important;
  text-shadow: 0 1px 3px rgba(0,0,0,0.4);
}

.bg-success {
  background-color: #28A745 !important; /* Bootstrap’s classic green */
  color: #FFFFFF !important;
  text-shadow: 0 1px 3px rgba(0,0,0,0.35);
}

.bg-danger {
  background-color: #DC3545 !important; /* Bootstrap’s rich red */
  color: #FFFFFF !important;
  text-shadow: 0 1px 3px rgba(0,0,0,0.4);
}


  /* Map Styling */
  #map {
    height: 550px;
    width: 100%;
    border-radius: 15px;
    border: 3px solid #004085;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    transition: box-shadow 0.3s ease;
  }

  #map:hover {
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
  }

  /* Table */
  table.dataTable thead th {
    background-color: #004085 !important;
    color: white !important;
    font-weight: 700;
  }

  table.dataTable.no-footer {
    border-radius: 15px;
    border: 3px solid #004085;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  }

  /* Table Container */
  .table-container h5 {
    margin-top: 40px;
    margin-bottom: 20px;
    color: #003366;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .stats-card {
      margin-bottom: 20px;
    }
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
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">SafeWay</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
<!-- Dashboard -->
<li class="nav-item">
  <a href="dashboard.php" class="nav-link ">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>Dashboard</p>
  </a>
</li>

<!-- Location & Map Features -->
<li class="nav-item">
  <a href="location_search.php" class="nav-link">
    <i class="nav-icon fas fa-search-location"></i>
    <p>Basic Location Search</p>
  </a>
</li>
<li class="nav-item">
  <a href="map_explore.php" class="nav-link">
    <i class="nav-icon fas fa-map-marked-alt"></i>
    <p>Map Exploration</p>
  </a>
</li>
<li class="nav-item">
  <a href="safety_ratings.php" class="nav-link active">
    <i class="nav-icon fas fa-eye"></i>
    <p>Visual Safety Ratings</p>
  </a>
</li>
<li class="nav-item">
  <a href="check_safety.php" class="nav-link">
    <i class="nav-icon fas fa-shield-alt"></i>
    <p>Check Before Going Out</p>
  </a>
</li>
<li class="nav-item">
  <a href="identify_routes.php" class="nav-link">
    <i class="nav-icon fas fa-route"></i>
    <p>Identify Safer Routes</p>
  </a>
</li>

<!-- Crime & Incident Insights -->
<li class="nav-item">
  <a href="filter_incidents.php" class="nav-link">
    <i class="nav-icon fas fa-filter"></i>
    <p>Filter Incidents</p>
  </a>
</li>
<li class="nav-item">
  <a href="crime_hotspot.php" class="nav-link">
    <i class="nav-icon fas fa-exclamation-triangle"></i>
    <p>Crime Hotspot Tracker</p>
  </a>
</li>

<!-- Resources & Community Support -->
<li class="nav-item">
  <a href="community_resources.php" class="nav-link">
    <i class="nav-icon fas fa-hands-helping"></i>
    <p>Community Resources</p>
  </a>
</li>

<!-- Educational Tools -->
<li class="nav-item">
  <a href="understand_factors.php" class="nav-link">
    <i class="nav-icon fas fa-lightbulb"></i>
    <p>Understanding Safety Factors</p>
  </a>
</li>
<li class="nav-item">
  <a href="legend_info.php" class="nav-link">
    <i class="nav-icon fas fa-map"></i>
    <p>Using the Legend</p>
  </a>
</li>

<!-- Communication -->
<li class="nav-item">
  <a href="send_notifications.php" class="nav-link">
    <i class="nav-icon fas fa-bell"></i>
    <p>Send Notifications</p>
  </a>
</li>
<li class="nav-item"><a href="all_notifications.php" class="nav-link "><i class="nav-icon fas fa-bell"></i><p>All Notifications</p></a></li>

<li class="nav-item">
  <a href="emergency_calls.php" class="nav-link">
    <i class="nav-icon fas fa-phone-alt"></i>
    <p>Emergency Calls</p>
  </a>
</li>

<!-- Logout -->
<li class="nav-item">
  <a href="login.html" class="nav-link">
    <i class="nav-icon fas fa-sign-out-alt"></i>
    <p>Logout</p>
  </a>
</li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h3>Visual Interpretation of Safety Ratings</h3>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">





          <!-- Stats -->
<div class="row text-white mb-4">
  <div class="col-md-4">
    <div class="stats-card bg-info p-3 rounded shadow text-center">
      <h3 class="count" data-count="<?= $totalRes->num_rows ?>">0</h3>
      <small>Total Resources</small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stats-card bg-success p-3 rounded shadow text-center">
      <h3 class="count" data-count="<?= $categoriesRes->num_rows ?>">0</h3>
      <small>Unique Categories</small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stats-card bg-danger p-3 rounded shadow text-center">
      <h3 class="count" data-count="<?= $locationsRes->num_rows ?>">0</h3>
      <small>Distinct Areas</small>
    </div>
  </div>
</div>







            <!-- Map -->
            <div id="map" class="mt-4"></div>

            <!-- Table -->
            <div class="table-container">
              <h5 class="mt-4 mb-2">Detailed Safety Ratings Table</h5>
              <table id="ratingsTable" class="display nowrap table table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                  <tr>
                    <th>Location</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Area Type</th>
                    <th>Reported Incidents</th>
                    <th>Safety Rating</th>
                    <th>Notes</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM safety_ratings";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['location']}</td>
                            <td>{$row['latitude']}</td>
                            <td>{$row['longitude']}</td>
                            <td>{$row['area_type']}</td>
                            <td>{$row['reported_incidents']}</td>
                            <td>{$row['safety_rating']}</td>
                            <td>{$row['notes']}</td>
                          </tr>";
                  }
                } else {
                  echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<!-- Leaflet -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
  // Map setup
  const map = L.map('map').setView([23.8103, 90.4125], 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  function getColor(rating) {
    return rating === 'high' ? 'green' :
           rating === 'medium' ? 'orange' : 'red';
  }

  // Fetch and plot safety points
  fetch('connect_php/get_safety_data.php')
    .then(res => res.json())
    .then(locations => {
      locations.forEach(loc => {
        const circle = L.circleMarker([loc.latitude, loc.longitude], {
          radius: 9,
          fillColor: getColor(loc.safety_rating.toLowerCase()),
          color: "#000",
          weight: 1,
          opacity: 1,
          fillOpacity: 0.75
        }).addTo(map);

        circle.bindTooltip(`<strong>${loc.location}</strong><br>Rating: <b>${loc.safety_rating.toUpperCase()}</b>`, {
          direction: 'top',
          offset: [0, -8],
          permanent: false,
          opacity: 0.9
        });
      });
    });

  // Map legend
  const legend = L.control({position: 'bottomright'});
  legend.onAdd = function () {
    const div = L.DomUtil.create('div', 'legend');
    div.innerHTML += '<strong>Safety Levels</strong><br>';
    div.innerHTML += '<i style="background:green"></i> High<br>';
    div.innerHTML += '<i style="background:orange"></i> Medium<br>';
    div.innerHTML += '<i style="background:red"></i> Low<br>';
    return div;
  };
  legend.addTo(map);

  // DataTable setup
  $(document).ready(function () {
    $('#ratingsTable').DataTable({
      responsive: true,
      dom: 'Bfrtip',
      buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5'],
      pageLength: 10
    });
  });



    // Animated counter
    $('.count').each(function () {
    let $this = $(this);
    let countTo = $this.attr('data-count');
    $({ countNum: $this.text() }).animate({
      countNum: countTo
    },
    {
      duration: 1000,
      easing: 'swing',
      step: function () {
        $this.text(Math.floor(this.countNum));
      },
      complete: function () {
        $this.text(this.countNum);
      }
    });
  });




</script>
</body>
</html>
