<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Crime Hotspot Tracker - SafeWay</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- External Libraries -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <style>
    :root {
      --primary: #0d6efd;
      --danger: #dc3545;
      --success: #28a745;
      --warning: #ffc107;
      --light: #f8f9fa;
      --dark: #212529;
    }

    body {
      margin: 0;
      font-family: 'Roboto', 'Segoe UI', sans-serif;
      background-color: var(--light);
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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

    #clock {
      font-size: 1rem;
      font-weight: normal;
    }

    #controls {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 1rem;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    #controls input, #controls select, #controls button {
      padding: 0.5rem 0.8rem;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      transition: all 0.2s ease;
    }

    #controls button:hover {
      background-color: var(--primary);
      color: white;
    }

    #map {
      flex: 1;
      min-height: 550px;
    }

    #alertBox, #safetyStatus, #crimeSummary {
      margin: 1rem auto;
      padding: 1rem;
      border-radius: 6px;
      max-width: 800px;
      text-align: center;
      display: none;
    }

    #crimeSummary {
      background-color: var(--dark);
      color: #fff;
      font-weight: bold;
    }

    #crimeChartContainer {
      background: #fff;
      margin: 1rem auto;
      padding: 1rem;
      border-radius: 10px;
      max-width: 800px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    #loader {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-weight: bold;
      font-size: 1.2rem;
      background: rgba(255,255,255,0.95);
      padding: 1rem 2rem;
      border-radius: 10px;
      display: none;
      z-index: 9999;
    }

    .dark-mode {
      background-color: #121212;
      color: #eee;
    }

    .dark-mode header {
      background-color: #1f1f1f;
    }

    .dark-mode #controls,
    .dark-mode #crimeChartContainer {
      background-color: #2a2a2a;
      color: #fff;
    }

    .dark-mode select, .dark-mode input, .dark-mode button {
      background-color: #444;
      color: white;
      border-color: #666;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="dashboard.php" class="nav-link">Home</a></li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="dashboard.php" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="SafeWay Logo" class="brand-image img-circle elevation-3">
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
  <a href="crime_hotspot.php" class="nav-link active">
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid pt-3">

          <div id="loader">Loading...</div>
          <header class="text-center py-2">
            <h3><span>🚨 SafeWay - Crime Hotspot Tracker</span></h3>
            <div id="clock"></div>
          </header>

          <div id="controls" class="mb-3 text-center">
            <input type="text" id="areaSearch" placeholder="Search by Area" />
            <select id="timeRange">
              <option value="7">Last 7 Days</option>
              <option value="30" selected>Last 30 Days</option>
              <option value="90">Last 90 Days</option>
            </select>
            <select id="crimeType">
              <option value="">All Types</option>
              <option value="Robbery">Robbery</option>
              <option value="Harassment">Harassment</option>
              <option value="Assault">Assault</option>
              <option value="Theft">Theft</option>
            </select>
            <button onclick="updateView()">🔄 Refresh</button>
            <button onclick="getUserLocation()">📍 My Safety</button>
            <button onclick="toggleHeatmap()">🔥 Toggle Heatmap</button>
            <button onclick="toggleDarkMode()">🌙 Dark Mode</button>
          </div>

          <div id="alertBox"></div>
          <div id="safetyStatus"></div>
          <div id="crimeSummary"></div>
          <div id="map" style="height: 500px;"></div>

          <div id="crimeChartContainer">
            <h3 style="text-align:center;">📊 Crime Incidents by Area</h3>
            <canvas id="crimeChart" height="150"></canvas>
          </div>

        </div>
      </section>
    </div>
</div>

<!-- JS Libraries -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
<!-- AdminLTE -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>










  <script>
    const map = L.map('map').setView([23.8103, 90.4125], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    let markersCluster = L.markerClusterGroup();
    map.addLayer(markersCluster);
    let heatLayer, crimeChart;
    let globalCrimeData = [];
    const alertThreshold = 7;

    function updateClock() {
      const now = new Date();
      document.getElementById('clock').textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    async function fetchCrimeData(days, type) {
      document.getElementById('loader').style.display = 'block';
      try {
        const url = `get_crime_data.php?days=${days}&type=${type}`;
        const res = await fetch(url);
        const json = await res.json();
        return json.data || [];
      } catch {
        alert("⚠️ Failed to fetch data.");
        return [];
      } finally {
        document.getElementById('loader').style.display = 'none';
      }
    }

    function aggregateByArea(data) {
      const areaMap = {};
      data.forEach(({ area, count }) => {
        areaMap[area] = (areaMap[area] || 0) + count;
      });
      return areaMap;
    }

    function prepareHeatPoints(data) {
      return data.map(d => [d.lat, d.lon, d.count]);
    }

    function clearMapLayers() {
      markersCluster.clearLayers();
      if (heatLayer) map.removeLayer(heatLayer);
    }

    function checkAlerts(areaCounts) {
      const alertBox = document.getElementById('alertBox');
      const hotspots = Object.entries(areaCounts).filter(([_, c]) => c >= alertThreshold);
      if (hotspots.length) {
        alertBox.style.display = 'block';
        alertBox.style.background = '#ffe6e6';
        alertBox.style.color = '#a00';
        alertBox.innerHTML = `⚠️ Hotspots: ${hotspots.map(([a, c]) => `${a} (${c})`).join(', ')}`;
      } else {
        alertBox.style.display = 'none';
      }
    }

    function renderMarkers(data) {
      data.forEach(({ lat, lon, area, date, type, count }) => {
        const emoji = {
          Robbery: '🧤', Harassment: '😡', Assault: '🥊', Theft: '👜'
        }[type] || '❗';
        const popup = `<b>${emoji} ${area}</b><br>${type} - ${count} report(s)<br><i>${date}</i>`;
        L.marker([lat, lon]).bindPopup(popup).addTo(markersCluster);
      });
    }

    function renderHeatmap(data) {
      const heatPoints = prepareHeatPoints(data);
      heatLayer = L.heatLayer(heatPoints, { radius: 25, blur: 20 }).addTo(map);
    }

    function updateCrimeChart(areaCounts) {
      const labels = Object.keys(areaCounts);
      const values = Object.values(areaCounts);
      const ctx = document.getElementById('crimeChart').getContext('2d');

      if (crimeChart) {
        crimeChart.data.labels = labels;
        crimeChart.data.datasets[0].data = values;
        crimeChart.update();
      } else {
        crimeChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels,
            datasets: [{
              label: 'Incidents',
              data: values,
              backgroundColor: '#dc3545'
            }]
          },
          options: {
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
          }
        });
      }
    }

    function toggleHeatmap() {
      if (heatLayer && map.hasLayer(heatLayer)) {
        map.removeLayer(heatLayer);
      } else {
        renderHeatmap(globalCrimeData);
      }
    }

    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
    }

    function showSummary(total) {
      const box = document.getElementById('crimeSummary');
      box.style.display = 'block';
      box.textContent = `📊 Total Incidents Displayed: ${total}`;
    }

    async function updateView() {
      const days = document.getElementById('timeRange').value;
      const type = document.getElementById('crimeType').value;
      const keyword = document.getElementById('areaSearch').value.toLowerCase();

      let data = await fetchCrimeData(days, type);
      if (keyword) {
        data = data.filter(d => d.area.toLowerCase().includes(keyword));
      }

      globalCrimeData = data;
      clearMapLayers();
      renderMarkers(data);
      renderHeatmap(data);
      const areaCounts = aggregateByArea(data);
      updateCrimeChart(areaCounts);
      checkAlerts(areaCounts);
      showSummary(data.reduce((sum, d) => sum + d.count, 0));
    }

    function getUserLocation() {
      if (!navigator.geolocation) return alert("Location not supported.");
      navigator.geolocation.getCurrentPosition(pos => {
        const { latitude, longitude } = pos.coords;
        const userLatLng = L.latLng(latitude, longitude);
        const radius = 0.5;

        const incidents = globalCrimeData.filter(d =>
          userLatLng.distanceTo([d.lat, d.lon]) / 1000 <= radius
        );
        const total = incidents.reduce((sum, d) => sum + d.count, 0);
        const status = document.getElementById('safetyStatus');
        status.style.display = 'block';

        if (total >= alertThreshold) {
          status.textContent = `🚨 High Risk Zone! ${total} incidents nearby.`;
          status.style.background = '#ffdddd';
          status.style.color = '#a00';
        } else if (total > 0) {
          status.textContent = `⚠️ Medium Risk: ${total} incidents nearby.`;
          status.style.background = '#fff3cd';
          status.style.color = '#856404';
        } else {
          status.textContent = `✅ You are in a low-risk area.`;
          status.style.background = '#d4edda';
          status.style.color = '#155724';
        }
      });
    }

    document.getElementById('areaSearch').addEventListener('input', updateView);
    updateView();
  </script>
</body>
</html>
