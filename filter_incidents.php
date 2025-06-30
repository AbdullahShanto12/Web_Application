<!-- filter_incidents.php -->
<?php
$mysqli = new mysqli("localhost", "root", "", "safeway");

// Fetch distinct filter options
$categories = $mysqli->query("SELECT DISTINCT category FROM incidents");
$areas = $mysqli->query("SELECT DISTINCT area FROM incidents");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Filter Incidents - SafeWay</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Google Font & AdminLTE CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
/* Overall background gradient for page */
body {
  background: linear-gradient(135deg, #e0f0ff 0%, #ffffff 100%);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #223344;
}

/* Wrapper tweak to add subtle shadow and round edges */
.wrapper {
  min-height: 100vh;
  box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
  border-radius: 15px;
  overflow: hidden;
}

/* Navbar */
.main-header.navbar {
  background: #004085;
  color: white;
  font-weight: 600;
  box-shadow: 0 3px 8px rgb(0 64 133 / 0.3);
  border-bottom: none;
}
.main-header.navbar .nav-link, .main-header.navbar .nav-icon {
  color: #cce0ff;
  transition: color 0.3s ease;
}
.main-header.navbar .nav-link:hover {
  color: #ffffff;
}

/* Content Wrapper */
.content-wrapper {
  background: #fdfefe;
  padding: 40px 35px 60px;
  min-height: calc(100vh - 56px);
}

/* Headings */
h2, h3 {
  border-bottom: 4px solid #0056b3;
  padding-bottom: 12px;
  margin-bottom: 30px;
  font-weight: 800;
  color: #003366;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}

/* Filters container */
.filters {
  background: linear-gradient(90deg, #d9e7ff, #ffffff);
  padding: 25px 30px;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
  margin-bottom: 40px;
  display: flex;
  flex-wrap: wrap;
  gap: 1.8rem 2.5rem;
  align-items: center;
  justify-content: center;
}

.filters label {
  font-weight: 700;
  color: #004085;
  font-size: 1.1rem;
  min-width: 90px;
  user-select: none;
}

.filters select, .filters input[type="date"] {
  border: 2px solid #0056b3;
  border-radius: 10px;
  padding: 10px 18px;
  font-size: 1.1rem;
  color: #003366;
  min-width: 180px;
  transition: all 0.3s ease;
  box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
  cursor: pointer;
}
.filters select:hover, .filters input[type="date"]:hover {
  border-color: #003366;
  box-shadow: 0 0 10px #0056b3aa;
}
.filters select:focus, .filters input[type="date"]:focus {
  border-color: #00254d;
  outline: none;
  box-shadow: 0 0 12px #003366cc;
}

/* Map styling */
#map {
  height: 500px;
  border-radius: 20px;
  box-shadow: 0 12px 28px rgba(0,0,0,0.2);
  margin-bottom: 40px;
  transition: box-shadow 0.3s ease;
  border: 4px solid #004085;
}
#map:hover {
  box-shadow: 0 18px 45px rgba(0,0,0,0.35);
}

/* Results container */
.results {
  background: #ffffff;
  border-radius: 15px;
  padding: 30px 35px;
  box-shadow: 0 10px 28px rgba(0,0,0,0.15);
  margin-bottom: 40px;
}

/* Incident list styling */
#incident-list {
  list-style: none;
  padding-left: 0;
  max-height: 320px;
  overflow-y: auto;
  font-size: 1.05rem;
}
#incident-list li {
  border-bottom: 1px solid #cce0ff;
  padding: 14px 0;
  font-weight: 600;
  color: #223344;
  cursor: default;
  transition: background-color 0.25s ease, color 0.25s ease;
  border-radius: 8px;
}
#incident-list li:hover {
  background-color: #d0e7ff;
  color: #00254d;
}

/* Chart canvas styling */
#incidentChart {
  border-radius: 20px;
  box-shadow: 0 14px 40px rgba(0,0,0,0.1);
  max-height: 450px;
}

/* Scrollbar for incident list */
#incident-list::-webkit-scrollbar {
  width: 8px;
}
#incident-list::-webkit-scrollbar-track {
  background: #f1f5fc;
  border-radius: 8px;
}
#incident-list::-webkit-scrollbar-thumb {
  background: #004085;
  border-radius: 8px;
}

/* Responsive tweaks */
@media (max-width: 991px) {
  .filters {
    flex-direction: column;
    gap: 1.5rem;
  }
  .filters select, .filters input[type="date"] {
    width: 100%;
    min-width: auto;
  }
}

@media (max-width: 480px) {
  h2, h3 {
    font-size: 1.5rem;
  }
  .filters label {
    font-size: 1rem;
    min-width: 80px;
  }
  .filters select, .filters input[type="date"] {
    font-size: 1rem;
    padding: 8px 15px;
  }
}

</style>








</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
        <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link font-weight-bold text-primary">Home</a></li>
      </ul>
    </nav>




  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">SafeWay</span>
    </a>
      <div class="sidebar">
        <nav class="mt-3">
          <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
            <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
            <li class="nav-item"><a href="location_search.php" class="nav-link"><i class="nav-icon fas fa-map-marker-alt"></i><p>Basic Location Search</p></a></li>
            <li class="nav-item"><a href="map_explore.php" class="nav-link"><i class="nav-icon fas fa-map"></i><p>Map Exploration</p></a></li>
            <li class="nav-item"><a href="safety_ratings.php" class="nav-link"><i class="nav-icon fas fa-eye"></i><p>Visual Safety Ratings</p></a></li>
            <li class="nav-item"><a href="check_safety.php" class="nav-link"><i class="nav-icon fas fa-shield-alt"></i><p>Check Before Going Out</p></a></li>
            <li class="nav-item"><a href="identify_routes.php" class="nav-link"><i class="nav-icon fas fa-route"></i><p>Identifying Safer Routes</p></a></li>
            <li class="nav-item"><a href="filter_incidents.php" class="nav-link active"><i class="nav-icon fas fa-filter"></i><p>Filter Incident</p></a></li>
            <li class="nav-item"><a href="understand_factors.php" class="nav-link"><i class="nav-icon fas fa-info-circle"></i><p>Understanding Safety Factors</p></a></li>
            <li class="nav-item"><a href="legend_info.php" class="nav-link"><i class="nav-icon fas fa-map-signs"></i><p>Using the Legend</p></a></li>
            <li class="nav-item"><a href="send_notifications.php" class="nav-link"><i class="nav-icon fas fa-bell"></i><p>Send Notifications</p></a></li>
            <li class="nav-item"><a href="emergency_calls.php" class="nav-link"><i class="nav-icon fas fa-phone-alt"></i><p>Emergency Calls</p></a></li>
            <li class="nav-item"><a href="login.html" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
      <div class="container-fluid">
        <h2>Filter Incidents</h2>

        <div class="filters" role="region" aria-label="Filter incidents by category, area, and date">
          <label for="category">Category:</label>
          <select id="category" aria-controls="incident-list">
            <option value="">All</option>
            <?php while ($row = $categories->fetch_assoc()): ?>
              <option value="<?= htmlspecialchars($row['category']) ?>"><?= htmlspecialchars($row['category']) ?></option>
            <?php endwhile; ?>
          </select>

          <label for="area">Area:</label>
          <select id="area" aria-controls="incident-list">
            <option value="">All</option>
            <?php while ($row = $areas->fetch_assoc()): ?>
              <option value="<?= htmlspecialchars($row['area']) ?>"><?= htmlspecialchars($row['area']) ?></option>
            <?php endwhile; ?>
          </select>

          <label for="date">Date:</label>
          <input type="date" id="date" aria-controls="incident-list" />
        </div>

        <div id="map" role="region" aria-label="Map showing filtered incidents"></div>

        <div class="results" aria-live="polite" aria-atomic="true">
          <h3>Incident List</h3>
          <ul id="incident-list" tabindex="0"></ul>
        </div>

        <div class="results" aria-live="polite" aria-atomic="true">
          <h3>Incident Chart</h3>
          <canvas id="incidentChart" aria-label="Bar chart showing incidents by category" role="img"></canvas>
        </div>
      </div>
    </div>

  </div>

  <!-- JS Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    const map = L.map('map').setView([23.8103, 90.4125], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const markers = [];

    function fetchFilteredData() {
      const category = document.getElementById("category").value;
      const area = document.getElementById("area").value;
      const date = document.getElementById("date").value;

      fetch(`get_filtered_data.php?category=${encodeURIComponent(category)}&area=${encodeURIComponent(area)}&date=${encodeURIComponent(date)}`)
        .then(response => response.json())
        .then(data => {
          updateMap(data);
          updateList(data);
          updateChart(data);
        });
    }

    function updateMap(data) {
      markers.forEach(m => map.removeLayer(m));
      markers.length = 0;

      if (data.length === 0) {
        map.setView([23.8103, 90.4125], 11);
        return;
      }

      const bounds = [];
      data.forEach(inc => {
        const marker = L.marker([inc.latitude, inc.longitude]).addTo(map)
          .bindPopup(`<strong>${inc.category}</strong><br>${inc.description}`);
        markers.push(marker);
        bounds.push([inc.latitude, inc.longitude]);
      });
      if (bounds.length > 0) map.fitBounds(bounds, {padding: [60, 60]});
    }
function updateList(data) {
  const list = document.getElementById("incident-list");
  list.innerHTML = "";
  if (data.length === 0) {
    list.innerHTML = "<li>No incidents found.</li>";
    return;
  }
  data.forEach(inc => {
    list.innerHTML += `<li><strong>${inc.category}</strong> - ${inc.area} (${inc.date})<br><em>${inc.description}</em></li>`;
  });
}


    function updateChart(data) {
      const ctx = document.getElementById('incidentChart').getContext('2d');
      const counts = {};
      data.forEach(d => counts[d.category] = (counts[d.category] || 0) + 1);

      if (window.chartInstance) window.chartInstance.destroy();
      window.chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Object.keys(counts),
          datasets: [{
            label: 'Number of Incidents',
            data: Object.values(counts),
            backgroundColor: 'rgba(0, 123, 255, 0.7)',
            borderRadius: 6,
            borderSkipped: false
          }]
        },
        options: {
          responsive: true,
          animation: {
            duration: 600,
            easing: 'easeOutQuart'
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: '#e3e9f3',
                borderColor: '#ccc'
              },
              ticks: {
                color: '#223344',
                font: {weight: '600'}
              }
            },
            x: {
              ticks: {
                color: '#223344',
                font: {weight: '600'}
              },
              grid: {
                display: false
              }
            }
          },
          plugins: {
            legend: { display: false },
            title: { display: true, text: 'Incidents by Category', color: '#004085', font: { size: 18, weight: '700' } },
            tooltip: {
              backgroundColor: '#004085',
              titleFont: { weight: '700' },
              bodyFont: { weight: '600' }
            }
          }
        }
      });
    }

    ["category", "area", "date"].forEach(id => {
      document.getElementById(id).addEventListener("change", fetchFilteredData);
    });

    fetchFilteredData();
  </script>
</body>
</html>
