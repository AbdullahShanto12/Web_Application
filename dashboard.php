<?php
// Start session
session_start();

// Include the database connection file
include 'connect.php';




// Use session data
$email = $_SESSION['email'] ?? null;
$role = $_SESSION['role'] ?? null;






?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard - SafeWay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Font -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <!-- AdminLTE -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>







    <style>
  /* General Interactive Elements */
  .info-box {
    cursor: pointer;
  }

  .card-body a {
    text-decoration: none;
  }

  ul li {
    transition: all 0.3s ease-in-out;
  }

  /* Dashboard Section */
  .dashboard-section {
    margin-top: 30px;
  }

  .dashboard-section .card-body {
    padding: 30px;
  }

  /* Feature Box Styling */
  .feature-box {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    transition: 0.3s ease-in-out;
  }

  .feature-box h5 {
    margin-bottom: 8px;
  }

  .feature-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    background-color: #f8f9fa;
  }

  /* Chart Container Styling */
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
}
.center-chart-content canvas {
  max-width: 100%;
  height: auto;
}

header {
      background-color: var(--primary);
      color: white;
      padding: 1rem;
      text-align: center;
      font-size: 1.7rem;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }


  .chart-title {
    font-size: 16px;
    font-weight: 500;
    text-align: center;
    margin-bottom: 10px;
    color: #343a40;
  }

  /* Color Utility Classes */
  .text-pink {
    color: #e83e8c;
  }

  .border-pink {
    border-color: #e83e8c !important;
  }

  .text-indigo {
    color: #6610f2;
  }

  .border-indigo {
    border-color: #6610f2 !important;
  }

  /* Responsive Adjustments */
  @media (max-width: 767.98px) {
    .chart-container {
      height: auto;
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
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link">Home</a>
          </li>
        </ul>
      </nav>




<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="SafeWay Logo" class="brand-image img-circle elevation-3" />
    <span class="brand-text font-weight-light">SafeWay</span>
  </a>

  <!-- Sidebar Menu -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column">
<!-- Dashboard -->
<li class="nav-item">
  <a href="dashboard.php" class="nav-link active">
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
        <section class="content-header">
          <div class="container-fluid">
            <h1 class="mb-2">Welcome, You're Safe Here 👋</h1>
            <p>
              Here's a quick overview of SafeWay features to help you stay safe.
            </p>
          </div>
        </section>






        <section class="content">
  <div class="container-fluid">
    <!-- Info Boxes -->
    <div class="row">

      <!-- Basic Location Search -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='location_search.php'">
          <span class="info-box-icon bg-info">
            <i class="fas fa-search-location"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Basic Location Search</span>
            <span class="info-box-number">Check safety scores of areas</span>
          </div>
        </div>
      </div>

      <!-- Map Exploration -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='map_explore.php'">
          <span class="info-box-icon bg-success">
            <i class="fas fa-map-marked-alt"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Map Exploration</span>
            <span class="info-box-number">Explore safety zones visually</span>
          </div>
        </div>
      </div>

      <!-- Visual Safety Ratings -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='safety_ratings.php'">
          <span class="info-box-icon bg-warning">
            <i class="fas fa-eye"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Visual Safety Ratings</span>
            <span class="info-box-number">Charts of crime rates and areas</span>
          </div>
        </div>
      </div>

      <!-- Check Before Going Out -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='check_safety.php'">
          <span class="info-box-icon bg-danger">
            <i class="fas fa-shield-alt"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Check Before Going Out</span>
            <span class="info-box-number">Analysis of your route’s safety</span>
          </div>
        </div>
      </div>

      <!-- Identify Safer Routes -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='identify_routes.php'">
          <span class="info-box-icon bg-primary">
            <i class="fas fa-route"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Identify Safer Routes</span>
            <span class="info-box-number">Suggests optimal paths based on crime data</span>
          </div>
        </div>
      </div>

      <!-- Filter Incidents -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='filter_incidents.php'">
          <span class="info-box-icon bg-orange">
            <i class="fas fa-filter"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Filter Incidents</span>
            <span class="info-box-number">Search by time, type, or location</span>
          </div>
        </div>
      </div>

      <!-- Crime Hotspot Tracker -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='crime_hotspot.php'">
          <span class="info-box-icon bg-danger">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Crime Hotspot Tracker</span>
            <span class="info-box-number">Monitor frequently dangerous areas</span>
          </div>
        </div>
      </div>

      <!-- Community Resources -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='community_resources.php'">
          <span class="info-box-icon bg-success">
            <i class="fas fa-hands-helping"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Community Resources</span>
            <span class="info-box-number">Access support centers near you</span>
          </div>
        </div>
      </div>

      <!-- Understanding Safety Factors -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='understand_factors.php'">
          <span class="info-box-icon bg-secondary">
            <i class="fas fa-lightbulb"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Understanding Safety Factors</span>
            <span class="info-box-number">Make informed decisions about safety</span>
          </div>
        </div>
      </div>

      <!-- Using the Legend -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='legend_info.php'">
          <span class="info-box-icon bg-teal">
            <i class="fas fa-map"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Using the Legend</span>
            <span class="info-box-number">Learn to interpret map safety ratings</span>
          </div>
        </div>
      </div>

      <!-- Send Notifications -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='send_notifications.php'">
          <span class="info-box-icon bg-purple">
            <i class="fas fa-bell"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Send Notifications</span>
            <span class="info-box-number">Alert users about nearby danger</span>
          </div>
        </div>
      </div>

      <!-- Emergency Calls -->
      <div class="col-md-4">
        <div class="info-box" onclick="window.location='emergency_calls.php'">
          <span class="info-box-icon bg-dark">
            <i class="fas fa-phone-alt"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Emergency Calls</span>
            <span class="info-box-number">Connect to help when you need it most</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>















<!-- Charts Section -->
<div class="dashboard-section">
  <div class="card">
    <div class="card-header bg-gradient-primary text-white">
      <h3 class="card-title">
        <i class="fas fa-chart-bar"></i> Safety Insights Dashboard
      </h3>
    </div>
    <div class="card-body">
      <p class="mb-4">
        Real-time safety analytics and trends in Dhaka based on data collection. Click on each chart to interact and explore.
      </p>
      <div class="container-fluid">
        <div class="row g-4">
          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Reported Crime Incidents by Area (Last 30 Days)</div>
              <canvas id="crimeChart"></canvas>
            </div>
          </div>

          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Safety Zone Distribution</div>
              <canvas id="areaSafetyPie"></canvas>
            </div>
          </div>

          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Weekly Usage of Safety Check Tool</div>
              <canvas id="routeCheckLine"></canvas>
            </div>
          </div>

<div class="col-md-6 col-xl-6">
  <div class="chart-container center-chart-content">
    <div class="chart-title">Feature Popularity Radar</div>
    <canvas id="featureRadar"></canvas>
  </div>
</div>


          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Weekly Crime Trends by Type</div>
              <canvas id="crimeTypeTrend"></canvas>
            </div>
          </div>

          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Avg. Emergency Response Time (by Area)</div>
              <canvas id="responseBar"></canvas>
            </div>
          </div>

          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">User Response to Push Notifications</div>
              <canvas id="notifEngage"></canvas>
            </div>
          </div>

          <div class="col-md-6 col-xl-6">
          <div class="chart-container center-chart-content">
          <div class="chart-title">Feedback, Safety, and Foot Traffic Analysis</div>
              <canvas id="bubbleFeedback"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Detailed Insights Banner -->
<div class="card mt-4 bg-gradient-primary text-white" style="cursor: pointer;" onclick="window.location.href='detailed_Insights.php'">
  <div class="card-body text-center">
    <h4><i class="fas fa-search-plus"></i> Explore Full Safety Insights & Trends</h4>
    <p class="mb-0">Click to dive deeper into location-based analytics, response times, trends, and more.</p>
  </div>
</div>








            <!-- Feature Summary -->
            <div class="dashboard-section">
              <div class="card shadow-lg border-0">
                <div
                  class="card-header bg-gradient-info text-white d-flex align-items-center"
                >
                  <h3 class="card-title mb-0">
                    <i class="fas fa-layer-group me-2"></i> Explore Our Powerful
                    Features
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row g-4">
                    <!-- Feature Box Template -->
                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-primary shadow-sm h-100"
                      >
                        <h5>
                          <i
                            class="fas fa-map-marker-alt text-primary me-2"
                          ></i>
                          Basic Location Search
                        </h5>
                        <p class="text-muted">
                          Discover safety scores instantly for any location in
                          Dhaka using real-time AI analysis. The system
                          evaluates crime statistics, foot traffic, and
                          environmental factors to give you an accurate safety
                          score for any area. Simply enter a location, and get a
                          snapshot of its safety levels.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-success shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-map text-success me-2"></i> Map
                          Exploration
                        </h5>
                        <p class="text-muted">
                          Visually explore crime zones, lighting, CCTV coverage,
                          and safe paths on an interactive map. Users can toggle
                          between different layers of data to identify high-risk
                          areas and safer routes. The map is regularly updated
                          to reflect real-time changes in safety conditions.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-danger shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-chart-pie text-danger me-2"></i>
                          Visual Safety Ratings
                        </h5>
                        <p class="text-muted">
                          Dive into colorful charts and analytics comparing
                          safety scores across neighborhoods. These visual tools
                          give users easy access to key metrics like crime
                          rates, lighting conditions, and police presence,
                          allowing you to make informed decisions about your
                          safety.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-warning shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-shield-alt text-warning me-2"></i>
                          Check Before Going Out
                        </h5>
                        <p class="text-muted">
                          Let AI scan your route and suggest safety levels
                          before you step outside. The system checks real-time
                          data on crime trends, traffic, and environmental
                          factors, helping you decide if your planned route is
                          safe or if you should consider alternatives.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-info shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-route text-info me-2"></i> Identify
                          Safer Routes
                        </h5>
                        <p class="text-muted">
                          Avoid unsafe areas with intelligent alternate path
                          suggestions based on live data. The app uses
                          historical data and real-time reports to suggest safer
                          routes that avoid high-risk zones, helping you
                          navigate through the city more securely.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-secondary shadow-sm h-100"
                      >
                        <h5>
                          <i
                            class="fas fa-search-location text-secondary me-2"
                          ></i>
                          Understanding Safety Factors
                        </h5>
                        <p class="text-muted">
                          Learn what influences safety scores—lighting, crowd
                          density, recent incidents, and more. This feature
                          helps you understand how various environmental and
                          social factors impact the safety of a given area. You
                          can make better decisions by knowing what makes a
                          place safe or risky.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-dark shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-info-circle text-dark me-2"></i>
                          Using the Map Legend
                        </h5>
                        <p class="text-muted">
                          Quickly understand symbols and color codes to decode
                          the safety map effectively. The map legend provides a
                          guide to help you interpret safety data, making it
                          easier to read the map and assess the risks in various
                          areas at a glance.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-pink shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-bell text-pink me-2"></i>
                          Notifications & Alerts
                        </h5>
                        <p class="text-muted">
                          Stay updated with timely alerts about risky zones and
                          changing conditions near you. The app sends
                          notifications when there are significant changes in
                          the safety of areas you're nearby or routes you're
                          planning to take. You'll always be informed when
                          something important happens in your surroundings.
                        </p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div
                        class="feature-box p-3 rounded bg-light border-start border-4 border-indigo shadow-sm h-100"
                      >
                        <h5>
                          <i class="fas fa-phone-alt text-indigo me-2"></i>
                          Emergency Calls
                        </h5>
                        <p class="text-muted">
                          Tap to quickly reach emergency services or share your
                          location with trusted contacts. This feature gives you
                          instant access to emergency phone numbers and allows
                          you to send your live location to friends, family, or
                          emergency responders if needed. Always stay connected
                          when help is just a tap away.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Safety Tips -->
            <div class="card mt-4 shadow-lg border-0">
              <div
                class="card-header bg-gradient-dark text-white d-flex align-items-center"
              >
                <h3 class="card-title mb-0">
                  <i class="fas fa-lightbulb me-2 text-warning"></i> Smart
                  Safety Tips Just for You
                </h3>
              </div>
              <div class="card-body bg-light">
                <ul class="list-unstyled row g-3">
                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-moon me-2 text-danger mt-1"></i>
                    <span
                      >Avoid poorly lit or isolated routes after dark — safety
                      begins with visibility.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-user-friends me-2 text-primary mt-1"></i>
                    <span
                      >Inform a friend or family member about your travel route
                      and ETA.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-shield-alt me-2 text-warning mt-1"></i>
                    <span
                      >Use the <strong>"Check Before Going Out"</strong> feature
                      to analyze your path.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-video me-2 text-info mt-1"></i>
                    <span
                      >Prefer routes with CCTV coverage and steady pedestrian
                      movement.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i
                      class="fas fa-location-arrow me-2 text-secondary mt-1"
                    ></i>
                    <span
                      >Enable real-time location sharing with your trusted
                      contacts.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-battery-full me-2 text-success mt-1"></i>
                    <span
                      >Keep your phone charged — carry a power bank just in
                      case!</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-phone me-2 text-pink mt-1"></i>
                    <span
                      >Set up emergency contacts for one-tap calling when it
                      counts.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-bell me-2 text-warning mt-1"></i>
                    <span
                      >Pay attention to safety alerts and push notifications
                      from the app.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i
                      class="fas fa-exclamation-triangle me-2 text-danger mt-1"
                    ></i>
                    <span
                      >If your gut says “no,” trust it — reroute instantly for
                      your peace of mind.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i
                      class="fas fa-headphones-alt me-2 text-secondary mt-1"
                    ></i>
                    <span
                      >Avoid using headphones in both ears when you're in a new
                      or quiet area.</span
                    >
                  </li>

                  <li class="col-md-6 d-flex align-items-start">
                    <i class="fas fa-history me-2 text-info mt-1"></i>
                    <span
                      >Use the SafeWay route history to reflect on and avoid
                      risky paths.</span
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <!-- Scripts -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>







    <script>
  fetch("get_dashboard.php")
    .then((response) => response.json())
    .then((data) => {
      const {
        crimeStats,
        safetyData,
        safetyChecks,
        featureUsage,
        crimeTypes,
        responseData,
        notifEngage,
        bubbleData,
      } = data;

      // === FILTER TOP 5 ===
      const topCrimeStats = crimeStats
        .sort((a, b) => b.incident_count - a.incident_count)
        .slice(0, 5);

      const topSafetyData = safetyData
        .sort((a, b) => b.value - a.value)
        .slice(0, 5);

      const topFeatureUsage = featureUsage
        .sort((a, b) => b.usage_count - a.usage_count)
        .slice(0, 5);

      const topResponseData = responseData
        .sort((a, b) => b.response_rating - a.response_rating)
        .slice(0, 5);

      const topBubbleData = bubbleData.slice(0, 5); // Assuming preprocessed for bubble chart
      const topNotifEngage = {
        labels: notifEngage.labels.slice(0, 5),
        datasets: notifEngage.datasets.map((ds) => ({
          ...ds,
          data: ds.data.slice(0, 5),
        })),
      };

      // === CHART 1: CRIME BAR CHART ===
      new Chart(document.getElementById("crimeChart"), {
        type: "bar",
        data: {
          labels: topCrimeStats.map((stat) => stat.area),
          datasets: [
            {
              label: "Incidents",
              data: topCrimeStats.map((stat) => stat.incident_count),
              backgroundColor: "#dc3545",
              borderWidth: 1,
            },
            {
              label: "Crime Index",
              data: topCrimeStats.map((stat) => stat.crime_index),
              backgroundColor: "#ffc107",
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: (ctx) =>
                  ctx.dataset.label === "Crime Index"
                    ? `Index: ${ctx.raw}`
                    : `Incidents: ${ctx.raw}`,
              },
            },
            title: {
              display: true,
              text: "Top 5 Crime-Prone Areas in Dhaka",
              font: { size: 18 },
            },
          },
          scales: {
            y: {
              beginAtZero: true,
              title: { display: true, text: "Value" },
            },
          },
        },
      });

      // === CHART 2: SAFETY PIE/DOUGHNUT CHART ===
      new Chart(document.getElementById("areaSafetyPie"), {
        type: "doughnut",
        data: {
          labels: topSafetyData.map((s) => `${s.category}: ${s.label}`),
          datasets: [
            {
              label: "Safety Distribution",
              data: topSafetyData.map((s) => s.value),
              backgroundColor: ["#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2"],
              hoverOffset: 10,
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Top 5 Safety Factors by Score",
              font: { size: 18 },
            },
            tooltip: {
              callbacks: {
                label: (ctx) =>
                  `${ctx.label} — Score: ${ctx.raw}, Weight: ${topSafetyData[ctx.dataIndex].weightage_percent}%`,
              },
            },
            legend: {
              position: "bottom",
              labels: { usePointStyle: true, boxWidth: 10 },
            },
          },
        },
      });

      // === CHART 3: SAFETY CHECK LINE CHART (All Days) ===
      const safetyCheckMap = {};
      safetyChecks.forEach((entry) => {
        const day = entry.check_day;
        safetyCheckMap[day] = (safetyCheckMap[day] || 0) + 1;
      });
      const dayLabels = Object.keys(safetyCheckMap);
      const checkCounts = Object.values(safetyCheckMap);

      new Chart(document.getElementById("routeCheckLine"), {
        type: "line",
        data: {
          labels: dayLabels,
          datasets: [
            {
              label: "Safety Checks",
              data: checkCounts,
              fill: true,
              borderColor: "#007bff",
              backgroundColor: "rgba(0, 123, 255, 0.2)",
              tension: 0.4,
              pointRadius: 5,
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Daily Safety Checks Across Dhaka",
              font: { size: 18 },
            },
            tooltip: {
              callbacks: { label: (ctx) => ` ${ctx.raw} checks` },
            },
          },
          scales: {
            y: {
              beginAtZero: true,
              title: { display: true, text: "Check Count" },
            },
          },
        },
      });

      // === CHART 4: FEATURE USAGE RADAR CHART ===
      new Chart(document.getElementById("featureRadar"), {
        type: "radar",
        data: {
          labels: topFeatureUsage.map((f) => f.feature),
          datasets: [
            {
              label: "Usage Count",
              data: topFeatureUsage.map((f) => f.usage_count),
              fill: true,
              backgroundColor: "rgba(40,167,69,0.2)",
              borderColor: "rgba(40,167,69,1)",
              pointBackgroundColor: "rgba(40,167,69,1)",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Top 5 Used SafeWay Features",
              font: { size: 18 },
            },
            legend: { display: false },
          },
          scales: {
            r: {
              angleLines: { display: true },
              suggestedMin: 0,
              suggestedMax: Math.max(...topFeatureUsage.map(f => f.usage_count)) + 5,
              pointLabels: { font: { size: 14 } },
            },
          },
        },
      });

      // === CHART 5: CRIME TYPE TREND LINE CHART (All Data) ===
        // Calculate total incidents per week
        const weekTotals = crimeTypes.labels.map((week, i) => {
          let total = 0;
          for (const dataset of crimeTypes.datasets) {
            total += dataset.data[i];
          }
          return { week, total };
        });

        // Sort weeks by total descending and take top 7
        const topWeeks = weekTotals
          .sort((a, b) => b.total - a.total)
          .slice(0, 7)
          .map((w) => w.week);

        // Filter labels to top 7 weeks
        const filteredLabels = topWeeks;

        // Filter each dataset's data to only include top 7 weeks in correct order
        const filteredDatasets = crimeTypes.datasets.map((ds) => {
          return {
            ...ds,
            data: topWeeks.map((week) => {
              const index = crimeTypes.labels.indexOf(week);
              return ds.data[index];
            }),
          };
        });

        // Now create the chart with filtered data
        new Chart(document.getElementById("crimeTypeTrend"), {
          type: "line",
          data: {
            labels: filteredLabels,
            datasets: filteredDatasets,
          },
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: "Top 7 Weeks of Crime Trends in Dhaka",
                font: { size: 18 },
              },
            },
          },
        });




      // === CHART 6: EMERGENCY RESPONSE BAR CHART ===
      new Chart(document.getElementById("responseBar"), {
        type: "bar",
        data: {
          labels: topResponseData.map((r) => `${r.service_type} - ${r.area}`),
          datasets: [
            {
              label: "Avg. Response Time (mins)",
              data: topResponseData.map((r) => r.average_response_time_min),
              backgroundColor: "#3498db",
            },
            {
              label: "Service Rating",
              data: topResponseData.map((r) => r.response_rating),
              backgroundColor: "#2ecc71",
            },
          ],
        },
        options: {
          indexAxis: "y",
          plugins: {
            title: {
              display: true,
              text: "Top 5 Emergency Response Performers",
              font: { size: 18 },
            },
          },
          scales: {
            x: {
              beginAtZero: true,
              title: { display: true, text: "Value" },
            },
          },
        },
      });

      // === CHART 7: NOTIFICATION INTERACTION STACKED BAR ===
      new Chart(document.getElementById("notifEngage"), {
        type: "bar",
        data: {
          labels: topNotifEngage.labels,
          datasets: topNotifEngage.datasets,
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Top 5 Notification Engagement Types",
              font: { size: 18 },
            },
            tooltip: { mode: "index", intersect: false },
            legend: { position: "bottom" },
          },
          scales: {
            x: { stacked: true },
            y: {
              stacked: true,
              beginAtZero: true,
              title: { display: true, text: "Count" },
            },
          },
        },
      });

      // === CHART 8: FEEDBACK BUBBLE CHART (Top 5) ===
      new Chart(document.getElementById("bubbleFeedback"), {
        type: "bubble",
        data: {
          datasets: topBubbleData,
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Top 5 Feedbacks (X: Positive, Y: Safety, R: Traffic)",
              font: { size: 18 },
            },
            tooltip: {
              callbacks: {
                label: (ctx) => {
                  const val = ctx.raw;
                  return `${ctx.dataset.label}: Feedback ${val.x}%, Safety ${val.y}%, Traffic Score: ${val.r}`;
                },
              },
            },
            legend: { position: "bottom" },
          },
          scales: {
            x: {
              title: { display: true, text: "Feedback Positivity (%)" },
              min: 0,
              max: 100,
            },
            y: {
              title: { display: true, text: "Safety Score (%)" },
              min: 0,
              max: 100,
            },
          },
        },
      });
    })
    .catch((error) =>
      console.error("Error loading dashboard data:", error)
    );
</script>



  </body>
</html>
