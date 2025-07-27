<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Location Search - SafeWay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <style>
/* 🌐 Base Styles */
/* 🌐 Base Styles */
body {
  background: linear-gradient(135deg, #e0f0ff 0%, #ffffff 100%);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #223344;
}

/* ⬛ Navbar Styles */
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

/* 🧭 Sidebar Styles */
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

/* 📄 Content Wrapper */
.content-wrapper {
  background: #fdfefe;
  padding: 40px 35px 60px;
  min-height: calc(100vh - 56px);
}

/* 📢 Headings (h2 and card titles) */
h2,
h3.card-title {
  border-bottom: 4px solid #0056b3;
  padding-bottom: 12px;
  margin-bottom: 30px;
  font-weight: 800;
  color: #003366;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}

/* 📦 Card Styles */
.card.card-info {
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
  border: none;
}

/* Card header with custom style */
.card.card-info .card-header {
  background-color: #004085;
  border-radius: 15px 15px 0 0;
  color: white;
}

/* Custom header class for enhanced styling */
.card-header.custom-header {
  background-color: #004085; /* same dark blue theme */
  color: #ffffff;            /* white text for contrast */
  font-weight: 700;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  gap: 10px;                 /* spacing between emoji and text */
  border-radius: 15px 15px 0 0;
  border-bottom: none;
  text-decoration: none;     /* remove underline */
  padding: 15px 25px;
  box-shadow: 0 4px 8px rgba(0, 64, 133, 0.3);
}

/* Card title inside the custom header */
.card-header.custom-header h3.card-title {
  margin: 0;                /* remove default margin */
  text-decoration: none;    /* ensure no underline */
  font-size: 1.4rem;
  font-weight: 700;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 10px;
  letter-spacing: 0.5px;
}


.custom-header {
  background: linear-gradient(135deg,rgb(1, 30, 73),rgb(143, 179, 214));
  border-radius: 15px 15px 0 0;
  padding: 20px 25px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

/* 🔍 Input Group (search box) */
.search-box input.form-control {
  border-radius: 10px 0 0 10px;
  border: 2px solid #0056b3;
  padding: 12px 15px;
  font-size: 1rem;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
  transition: 0.3s;
}

.search-box input.form-control:focus {
  border-color: #00254d;
  box-shadow: 0 0 10px #0056b3aa;
}

.search-box .btn.btn-info {
  background-color: #004085;
  border-color: #004085;
  border-radius: 0 10px 10px 0;
  font-weight: bold;
  transition: 0.3s;
}

.search-box .btn.btn-info:hover {
  background-color: #00254d;
}

/* 🗺️ Map Styling */
#map {
  height: 450px;
  border-radius: 15px;
  border: 3px solid #004085;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
  transition: box-shadow 0.3s ease;
}

#map:hover {
  box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
}

/* 🧾 Info Cards */
.info-card .info-box {
  background: #ffffff;
  border-radius: 14px;
  padding: 18px;
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s;
}

.info-card .info-box:hover {
  transform: translateY(-3px);
}

.info-card h5 {
  font-weight: 700;
  color: #004085;
  margin-bottom: 10px;
  font-size: 1rem;
}

/* Highlighted text styling */
.highlight {
  color: #17a2b8;
  font-weight: bold;
}

/* List styles */
ul {
  padding-left: 1.2rem;
}

ul li {
  margin-bottom: 6px;
  color: #333;
}

/* 🪟 Responsive adjustments */
@media (max-width: 768px) {
  .search-box input.form-control,
  .search-box .btn.btn-info {
    width: 100%;
    border-radius: 10px !important;
    margin-top: 10px;
  }

  .info-card {
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
                <ul class="nav nav-pills nav-sidebar flex-column">
<!-- Dashboard -->
<li class="nav-item">
  <a href="dashboard.php" class="nav-link ">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>Dashboard</p>
  </a>
</li>

<!-- Location & Map Features -->
<li class="nav-item">
  <a href="location_search.php" class="nav-link active">
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



    

    <!-- Main Content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h2>Basic Location Search</h2>
                <p>Search any area in Dhaka and get safety details & map context instantly.</p>
            </div>
        </section>


        <section class="content">
    <div class="container-fluid">
        <div class="card card-info">
        <div class="card-header custom-header">
  <h3 class="card-title">📍 Search for a Location</h3>
</div>

            <div class="card-body">
                <form id="location-form">
                    <div class="input-group search-box">
                        <input type="text" id="location-input" class="form-control" placeholder="Enter a location (e.g. Dhanmondi, Dhaka)">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                </form>

                <div id="map" class="mt-3 mb-4" style="height: 400px;"></div>

                <div class="row">
                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>📊 Safety Score</h5>
                            <p><span id="safety-score" class="highlight"></span></p>
                        </div>
                    </div>

                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>🏥 Nearby Hospitals</h5>
                            <ul id="hospital-list"></ul>
                        </div>
                    </div>

                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>👮 Nearby Police Stations</h5>
                            <ul id="police-list"></ul>
                        </div>
                    </div>

                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>📈 Crime Trends (Last 30 Days)</h5>
                            <p id="crime-trends"></p>
                        </div>
                    </div>

                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>📞 Emergency Contact Info</h5>
                            <ul id="emergency-info"></ul>
                        </div>
                    </div>

                    <div class="col-md-6 info-card">
                        <div class="info-box">
                            <h5>🛡️ Safety Tips</h5>
                            <ul id="safety-tips"></ul>
                        </div>
                    </div>
                </div>
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
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
const map = L.map('map').setView([23.8103, 90.4125], 12); // Default to Dhaka
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

let marker;

document.getElementById("location-form").addEventListener("submit", function(e) {
    e.preventDefault();
    const query = document.getElementById("location-input").value.trim();
    if (!query) return;

    // Geocode location
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query + ", Dhaka")}`)
        .then(res => res.json())
        .then(data => {
            if (data.length > 0) {
                const place = data[0];
                const lat = place.lat;
                const lon = place.lon;

                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lon]).addTo(map)
                    .bindPopup(`<strong>${place.display_name}</strong>`).openPopup();

                map.setView([lat, lon], 15);

                // Fetch safety details from PHP backend
                fetch(`connect_php/get_location_data.php?location=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            document.getElementById("safety-score").textContent = "N/A";
                            console.warn(data.error);
                            return;
                        }

                        document.getElementById("safety-score").textContent = `${data.safety_score}/10`;

                        // Hospitals
                        const hospitalList = document.getElementById("hospital-list");
                        hospitalList.innerHTML = "";
                        data.hospitals.split(",").forEach(h => {
                            const li = document.createElement("li");
                            li.textContent = h.trim();
                            hospitalList.appendChild(li);
                        });

                        // Police stations
                        const policeList = document.getElementById("police-list");
                        policeList.innerHTML = "";
                        data.police_stations.split(",").forEach(p => {
                            const li = document.createElement("li");
                            li.textContent = p.trim();
                            policeList.appendChild(li);
                        });

                        // Crime trend
                        document.getElementById("crime-trends").textContent = data.crime_trend;

                        // Emergency contacts (static for now)
                        const emergencyList = document.getElementById("emergency-info");
                        emergencyList.innerHTML = `
                            <li>Police: <strong>999</strong></li>
                            <li>Women’s Helpline: <strong>109</strong></li>
                            <li>Fire: <strong>199</strong></li>
                        `;

                        // Safety tips (static for now)
                        const tipsList = document.getElementById("safety-tips");
                        tipsList.innerHTML = `
                            <li>Avoid dark alleys after 8 PM.</li>
                            <li>Use main roads or ride-share services.</li>
                            <li>Stay in well-lit areas if walking alone.</li>
                        `;
                    })
                    .catch(err => {
                        console.error("Backend fetch error:", err);
                    });
            } else {
                alert("Location not found. Please try a different search.");
            }
        })
        .catch(err => {
            console.error("Geocoding error:", err);
            alert("Error fetching location data.");
        });
});
</script>

</body>
</html>
