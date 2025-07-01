<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Check Before Going Out - SafeWay</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts & AdminLTE CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" />
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <style>
    body {
      font-family: 'Source Sans Pro', sans-serif;
    }

    #map {
      height: 550px;
      width: 100%;
      border-radius: 15px;
      border: 2px solid #74b9ff;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .safety-score {
      font-size: 1.8rem;
      font-weight: 700;
      padding: 14px 22px;
      border-radius: 12px;
      display: inline-block;
      margin-top: 20px;
      animation: pulse 2s infinite ease-in-out;
      color: #fff;
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.03); opacity: 0.9; }
      100% { transform: scale(1); opacity: 1; }
    }

    .feature-card {
      border-radius: 15px;
      padding: 20px;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #ffffff 0%, #f1f2f6 100%);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
    }

    .feature-title {
      font-weight: 700;
      font-size: 1.3rem;
      color: #0984e3;
      margin-bottom: 10px;
    }

    .btn {
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 18px;
    }

    .btn-primary {
      background-color: #0984e3;
      border-color: #0984e3;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #74b9ff;
      border-color: #74b9ff;
    }

    input.form-control {
      border-radius: 12px;
      padding: 12px 18px;
      border: 1px solid #dfe6e9;
      background-color: #ffffff;
    }

    ul {
      padding-left: 20px;
    }

    ul li {
      margin-bottom: 6px;
      font-size: 1rem;
    }

    #transportScores div {
      margin: 6px 0;
      font-weight: 600;
      color: #2d3436;
    }

    h2 {
      font-size: 2rem;
      font-weight: 800;
      color: #2d3436;
      margin-bottom: 25px;
    }

    #clock {
      font-size: 1rem;
      font-weight: normal;
    }

    label {
      font-weight: 700;
      color: #636e72;
    }

    #result {
      margin-top: 15px;
      font-size: 1.2rem;
    }

    .search-box {
      margin-bottom: 20px;
    }

    .info-card {
      margin-bottom: 15px;
    }

    .info-box {
      background-color: #f4f6f9;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
    }

    .info-box h5 {
      font-weight: 600;
    }

    .highlight {
      color: #17a2b8;
      font-weight: bold;
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

    @media (max-width: 768px) {
      #map {
        height: 300px;
      }

      h2 {
        font-size: 1.6rem;
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
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Home</a>
        </li>
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
            <!-- Dashboard -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
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
              <a href="check_safety.php" class="nav-link active">
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





<!-- Main Content -->
<div class="content-wrapper p-3">
  <div class="container-fluid">
    <!-- Header -->
    <header class="text-center py-2">
      <h3><span>🔎 Check Safety Before Going Out</span></h3>
      <div id="clock"></div>
    </header>

    <!-- Location Input -->
    <div class="form-group mt-3">
      <label for="locationInput">Enter Location:</label>
      <input type="text" id="locationInput" class="form-control" placeholder="e.g., Dhanmondi, Dhaka">
    </div>
    <button class="btn btn-primary mt-2" onclick="checkSafety()">Check Safety</button>

    <!-- Safety Score Result -->
    <div id="result" class="mt-4"></div>

    <!-- Map -->
    <div id="map" class="mt-4" style="height: 550px;"></div>

    <!-- Features (initially hidden) -->
    <div id="features" class="mt-4" style="display: none;">
      <div class="feature-card">
        <div class="feature-title">1. Time-Sensitive Safety Advisory</div>
        <div id="timeAdvisory">Checking...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">2. Nearby Police Stations</div>
        <ul id="policeList"></ul>
      </div>

      <div class="feature-card">
        <div class="feature-title">3. Emergency Contacts</div>
        <p>
          <a href="tel:999" class="btn btn-danger btn-sm">Call Police (999)</a>
          <a href="tel:199" class="btn btn-warning btn-sm">Fire Service (199)</a>
          <a href="tel:16263" class="btn btn-info btn-sm">Health Help (16263)</a>
        </p>
      </div>

      <div class="feature-card">
        <div class="feature-title">4. Weather-Based Advisory</div>
        <div id="weatherAdvisory">...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">5. Crowd Density Estimator</div>
        <div id="crowdDensity">...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">6. Last Reported Incidents</div>
        <ul id="incidentList"></ul>
      </div>

      <div class="feature-card">
        <div class="feature-title">7. Public Transport Safety Score</div>
        <div id="transportScores"></div>
      </div>

      <div class="feature-card">
        <div class="feature-title">8. Estimated Lighting Conditions</div>
        <div id="lightingEstimator">Checking...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">9. Clothing Tip</div>
        <div id="clothingTip">Checking...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">10. Estimated Noise Level</div>
        <div id="noiseLevel">Checking...</div>
      </div>

      <div class="feature-card">
        <div class="feature-title">11. Mood Forecast 🌤️</div>
        <div id="moodForecast">Analyzing...</div>
      </div>
    </div>
  </div>
</div>

<!-- JS Dependencies -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
  const map = L.map('map').setView([23.8103, 90.4125], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 }).addTo(map);
  let currentMarker;

  function estimateLighting() {
    const hour = new Date().getHours();
    const zoom = map.getZoom();
    let lighting = "Unknown";

    if (hour >= 6 && hour <= 17) {
      lighting = "Bright daylight — visibility is good.";
    } else if (hour > 17 && hour < 20) {
      lighting = "Dusk — street lights may vary.";
    } else {
      lighting = zoom >= 15
        ? "Urban night — streets likely lit."
        : "Dark zone — lighting might be poor.";
    }

    document.getElementById("lightingEstimator").textContent = lighting;
  }

  map.on('zoomend', estimateLighting);

  function clothingTipFromWeather(weatherText) {
    const tipBox = document.getElementById("clothingTip");
    const text = weatherText.toLowerCase();

    if (text.includes("rain")) tipBox.textContent = "Carry an umbrella or raincoat.";
    else if (text.includes("hot") || text.includes("sunny")) tipBox.textContent = "Wear light and breathable clothes.";
    else if (text.includes("cold") || text.includes("chill")) tipBox.textContent = "Dress warmly in layers.";
    else tipBox.textContent = "Dress comfortably for general conditions.";
  }

  function estimateNoiseLevel(crowd) {
    const hour = new Date().getHours();
    const isPeak = (hour >= 7 && hour <= 9) || (hour >= 17 && hour <= 20);
    let noise = "Quiet";

    if (crowd.toLowerCase().includes("high")) {
      noise = isPeak ? "Very loud — rush hour crowd." : "Loud — heavy presence.";
    } else if (crowd.toLowerCase().includes("moderate")) {
      noise = "Moderate — some foot traffic.";
    }

    document.getElementById("noiseLevel").textContent = noise;
  }

  function moodForecast(score) {
    let mood = "Neutral vibes 🌫️";
    if (score > 80) mood = "Positive vibes 🌞 — feels like a good time to go out!";
    else if (score > 50) mood = "Mixed vibes 🌤️ — stay alert, stay safe!";
    else mood = "Caution vibes 🌧️ — better wait or be highly cautious.";

    document.getElementById("moodForecast").textContent = mood;
  }

  function checkSafety() {
    const location = document.getElementById('locationInput').value.trim();
    if (!location) return alert("Please enter a location.");

    fetch(`get_check_safety.php?location=${encodeURIComponent(location)}`)
      .then(response => response.json())
      .then(data => {
        if (data.error) return alert(data.error);

        const {
          lat, lon, safety_score, police_stations,
          weather_advisory, crowd_density, incidents, transport_scores
        } = data;

        // Update map
        if (currentMarker) map.removeLayer(currentMarker);
        currentMarker = L.marker([lat, lon]).addTo(map).bindPopup(location).openPopup();
        map.setView([lat, lon], 15);

        // Safety Score
        const safetyColor = safety_score > 70 ? 'green' : (safety_score > 40 ? 'orange' : 'red');
        document.getElementById('result').innerHTML = `
          <div class="safety-score p-3" style="background-color:${safetyColor}; color:white; border-radius:10px;">
            Safety Score: ${safety_score}/100
          </div>
        `;

        // Police Stations
        const policeList = document.getElementById('policeList');
        policeList.innerHTML = "";
        police_stations.forEach(station => {
          const li = document.createElement("li");
          li.textContent = station;
          policeList.appendChild(li);
        });

        // Weather
        document.getElementById('weatherAdvisory').textContent = weather_advisory;

        // Crowd Density
        document.getElementById('crowdDensity').innerHTML =
          `Estimated: <strong>${crowd_density}</strong> crowd in your area right now.`;

        // Incidents
        const incidentList = document.getElementById('incidentList');
        incidentList.innerHTML = "";
        incidents.forEach(item => {
          const li = document.createElement("li");
          li.textContent = item;
          incidentList.appendChild(li);
        });

        // Transport Scores
        const transportDiv = document.getElementById('transportScores');
        transportDiv.innerHTML = "";
        for (const [type, score] of Object.entries(transport_scores)) {
          transportDiv.innerHTML += `<div>${type}: <span>${score}</span></div>`;
        }

        // Advisory
        const hour = new Date().getHours();
        const timeMessage = (hour >= 18 || hour <= 5)
          ? "It's dark outside. Be extra cautious and avoid poorly lit areas."
          : "It's daytime. Still, remain alert and aware of your surroundings.";
        document.getElementById('timeAdvisory').textContent = timeMessage;

        // Extra features
        clothingTipFromWeather(weather_advisory);
        estimateNoiseLevel(crowd_density);
        moodForecast(safety_score);
        estimateLighting();

        // Show features
        document.getElementById("features").style.display = "block";
      })
      .catch(err => {
        alert("Failed to fetch safety data. Please try again later.");
        console.error(err);
      });
  }

  function updateClocks() {
    const now = new Date();
    const time = now.toLocaleTimeString();

    const clock1 = document.getElementById('clock');
    if (clock1) clock1.textContent = time;
  }

  setInterval(updateClocks, 1000);
  updateClocks();
</script>

</body>
</html>
