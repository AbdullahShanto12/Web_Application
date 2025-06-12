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
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
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
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        .info-box h5 {
            font-weight: 600;
        }
        .highlight {
            color: #17a2b8;
            font-weight: bold;
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
                    <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
                    <li class="nav-item"><a href="location_search.php" class="nav-link active"><i class="nav-icon fas fa-map-marker-alt"></i><p>Basic Location Search</p></a></li>
                    <li class="nav-item"><a href="map_explore.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Map Exploration</p></a></li>
                    <li class="nav-item"><a href="safety_ratings.php" class="nav-link"><i class="nav-icon fas fa-eye"></i><p>Visual Safety Ratings</p></a></li>
                    <li class="nav-item"><a href="check_safety.php" class="nav-link"><i class="nav-icon fas fa-shield-alt"></i><p>Check Before Going Out</p></a></li>
                    <li class="nav-item"><a href="identify_routes.php" class="nav-link"><i class="nav-icon fas fa-route"></i><p>Identifying Safer Routes</p></a></li>

                    <li class="nav-item"><a href="understand_factors.php" class="nav-link"><i class="nav-icon fas fa-info-circle"></i><p>Understanding Safety Factors</p></a></li>
                    <li class="nav-item"><a href="legend_info.php" class="nav-link"><i class="nav-icon fas fa-map-signs"></i><p>Using the Legend</p></a></li>
                    <li class="nav-item"><a href="send_notifications.php" class="nav-link"><i class="nav-icon fas fa-bell"></i><p>Send Notifications</p></a></li>
                    <li class="nav-item"><a href="emergency_calls.php" class="nav-link "><i class="nav-icon fas fa-phone-alt"></i><p>Emergency Calls</p></a></li>
                    <li class="nav-item"><a href="login.html" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h2>Basic Location Search</h2>
                <p class="text-muted">Search any area in Dhaka and get safety details & map context instantly.</p>
            </div>
        </section>




        <section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Search for a Location</h3>
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
                                    <p>Moderate increase in petty theft reported in nearby areas.</p>
                                </div>
                            </div>
                    <div class="col-md-6 info-card">
                                <div class="info-box">
                                    <h5>📞 Emergency Contact Info</h5>
                                    <ul>
                                        <li>Police: <strong>999</strong></li>
                                        <li>Women’s Helpline: <strong>109</strong></li>
                                        <li>Fire: <strong>199</strong></li>
                                    </ul>
                                </div>
                            </div>


                            <div class="col-md-6 info-card">
                                <div class="info-box">
                                    <h5>🛡️ Safety Tips</h5>
                                    <ul>
                                        <li>Avoid dark alleys after 8 PM.</li>
                                        <li>Use main roads or ride-share services.</li>
                                        <li>Stay in well-lit areas if walking alone.</li>
                                    </ul>
                                </div>
                            </div>

                </div>
            </div> <!-- /.card-body -->
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
                fetch(`get_location_data.php?location=${encodeURIComponent(query)}`)
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
                        const crimeBox = document.querySelector(".info-box:nth-of-type(4) p");
                        crimeBox.textContent = data.crime_trend;
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








    const map = L.map('map').setView([23.8103, 90.4125], 12); // Default to Dhaka
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    document.getElementById("location-form").addEventListener("submit", function(e) {
        e.preventDefault();
        const query = document.getElementById("location-input").value.trim();
        if (!query) return;

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

                    // Mock safety score for now
                    const randomScore = (Math.random() * 5 + 5).toFixed(1);
                    document.getElementById("safety-score").textContent = `${randomScore}/10`;
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
