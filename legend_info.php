<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Using the Map Legend - SafeWay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font & AdminLTE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<style>
  :root {
    --primary: #004085;
    --accent: #007bff;
    --highlight: #17a2b8;
    --light-bg: #f4f7fb;
    --dark-bg: #1c1f22;
    --white: #ffffff;
    --card-bg: #ffffff;
    --dark-card: #2c2f34;
    --text-dark: #2d3436;
    --text-light: #ddd;
    --danger: #dc3545;
  }

  body {
    font-family: 'Source Sans Pro', sans-serif;
    background-color: var(--light-bg);
    color: var(--text-dark);
    transition: background 0.3s, color 0.3s;
    margin: 0;
  }

  .content-wrapper {
    background: var(--light-bg);
    padding: 2rem 1rem;
    transition: background 0.3s;
  }

  h2 {
    color: var(--primary);
    border-bottom: 3px solid var(--primary);
    padding-bottom: 12px;
    margin-bottom: 25px;
    font-weight: 700;
  }

  .feature-card {
    border: 1px solid #dbe6f4;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: var(--card-bg);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    transition: 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
  }

  .feature-title {
    font-weight: 700;
    font-size: 1.3rem;
    color: var(--primary);
    margin-bottom: 15px;
    display: flex;
    align-items: center;
  }

  .feature-title i {
    font-size: 1.4rem;
    margin-right: 10px;
    color: var(--accent);
  }

  .icon-legend {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    font-size: 1rem;
    color: #333;
  }

  .legend-color {
    display: inline-block;
    width: 26px;
    height: 26px;
    border-radius: 6px;
    margin-right: 12px;
    border: 2px solid #fff;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
  }

  .legend-description {
    font-size: 0.95rem;
    color: #555;
    margin-top: 10px;
  }

  ul {
    padding-left: 20px;
  }

  p.mb-4 {
    font-size: 1.05rem;
    color: #555;
  }

  /* Navbar */
  .main-header.navbar {
    background-color: var(--primary);
    color: white;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
  }

  .main-header .nav-link {
    color: #cfe7ff;
    font-weight: 500;
  }

  .main-header .nav-link:hover {
    color: white;
  }

  /* Sidebar */
  .main-sidebar {
    background-color: var(--dark-bg);
    color: var(--white);
  }

  .main-sidebar .brand-link {
    background-color: #22262b;
    color: white;
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

  /* Optional: Mobile responsive tweaks */
  @media (max-width: 768px) {
    .feature-title {
      font-size: 1.1rem;
    }

    .legend-color {
      width: 22px;
      height: 22px;
    }

    .feature-card {
      padding: 16px;
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
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
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
  <a href="safety_ratings.php" class="nav-link">
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
  <a href="legend_info.php" class="nav-link active">
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

    <!-- Main Content -->
    <div class="content-wrapper p-3">
        <div class="container-fluid">
            <h2><i class="fas fa-map-signs text-primary"></i> Using the Map Legend</h2>
            <p class="mb-4">Learn how to interpret map visuals to make informed and safe travel decisions.</p>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-palette"></i> 1. Color Codes for Area Safety</div>
                <div class="icon-legend"><span class="legend-color" style="background-color: green;"></span> Safe Area (Score 70+)</div>
                <div class="icon-legend"><span class="legend-color" style="background-color: orange;"></span> Moderate Risk (Score 41–69)</div>
                <div class="icon-legend"><span class="legend-color" style="background-color: red;"></span> High Risk Zone (Score ≤ 40)</div>
                <p class="legend-description">These colors quickly tell you the level of caution needed in each area. Green is safest, red signals high alert.</p>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-route"></i> 2. Route Colors</div>
                <div class="icon-legend"><span class="legend-color" style="background-color: blue;"></span> Recommended Safe Route</div>
                <div class="icon-legend"><span class="legend-color" style="background-color: gray;"></span> Alternate Route (Unrated)</div>
                <p class="legend-description">Follow blue for the safest paths. Gray routes are unexplored and might not be assessed.</p>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-icons"></i> 3. Map Icons Explained</div>
                <div class="icon-legend"><i class="fas fa-shield-alt text-primary"></i> Police Station / Security Booth</div>
                <div class="icon-legend"><i class="fas fa-camera text-dark"></i> CCTV Coverage Area</div>
                <div class="icon-legend"><i class="fas fa-exclamation-triangle text-danger"></i> Recent Incident Reported</div>
                <div class="icon-legend"><i class="fas fa-umbrella text-info"></i> Weather Advisory Zone</div>
                <div class="icon-legend"><i class="fas fa-bus text-success"></i> Safe Public Transport Stop</div>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-layer-group"></i> 4. Map Layers</div>
                <p>Toggle map layers using the icon at the top-right to focus on specific data:</p>
                <ul>
                    <li>Incident Heatmap</li>
                    <li>Police & Security Presence</li>
                    <li>Lighting & Camera Zones</li>
                    <li>Transport Safety Scores</li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-map-marker-alt"></i> 5. Marker Details</div>
                <p>Click or tap on any map marker to access real-time reports, safety tips, and emergency contacts relevant to that location.</p>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-sliders-h"></i> 6. Custom Filters</div>
                <p>Use custom legend filters to highlight areas based on your safety preferences such as low-crime zones, night travel safety, or proximity to safe transport.</p>
            </div>

            <div class="feature-card">
                <div class="feature-title"><i class="fas fa-info-circle"></i> 7. Safety Score Tooltip</div>
                <p>Hovering over an area reveals a tooltip with numeric safety scores, trends over the past week, and recommended actions.</p>
            </div>

        </div>
    </div>
</div>

<!-- JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
