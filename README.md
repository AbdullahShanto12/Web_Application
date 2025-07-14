
---

# 🛡️ SafeWay – Women’s Safety Companion Web App 🌐

**SafeWay** is a carefully curated, interactive, and **safety-first web application** designed to empower women to navigate their city with confidence and peace of mind. Focused on the streets of **Dhaka, Bangladesh**, SafeWay displays **real-time location safety information**, manually updated by admins and visualized on a user-friendly, map-based interface. Alongside, it offers emergency contact management, insightful usage dashboards, and interactive safety tools — all crafted with **clarity, security, and user empowerment** as core principles.

---

## ✨ Current Features (Admin-Driven)

### 📍 Safety Map Explorer

* Explore Dhaka via a **Leaflet.js-powered interactive map**.
* Clickable markers display:

  * **Safety Score** (0.0 – 10.0)
  * **Lighting Condition**
  * **Crowd Density**
* All safety data and locations are **manually managed by admins** through the backend.

### 📊 Insights Dashboard

* Visual, easy-to-understand dashboards showing:

  * Area-wise crime reports (last 30 days)
  * Weekly usage stats for safety features
  * Distribution of safety zones by risk level
  * Average emergency response times
  * User feedback correlated with foot traffic and safety

### 👤 User Profiles

* Simple login/signup with session management.
* Update personal details and monitor safety tool usage.
* No AI-driven recommendations; users interpret data and decide manually.

### 🚨 Emergency & Trusted Contact System

* Add, edit, and manage trusted emergency contacts.
* SOS button triggers alerts to trusted contacts (simulated in current version).
* Alerts show contact details to provide immediate support options.

### 🎛️ Interactive Map Controls

* Toggle clustering for densely populated markers.
* Dark mode support for night-time usability.
* Radius-based safety alerts to highlight critical zones.
* Filters to view locations by safety score, lighting, and crowd density.

### 🗃️ Admin Portal – Manual Data Management

* Admins can add, update, or remove safe locations.
* Edit crowd density, lighting status, and safety scores.
* Manage user feedback and monitor contact logs.

---

## 🧰 Tech Stack

| Layer        | Technology Used                                          |
| ------------ | -------------------------------------------------------- |
| **Frontend** | HTML5, CSS3, Bootstrap, JavaScript, Leaflet.js, Chart.js |
| **Backend**  | PHP (XAMPP stack), basic AJAX                            |
| **Database** | MySQL (XAMPP)                                            |
| **Mapping**  | OpenStreetMap via Leaflet.js                             |

---

## ⚙️ Setup Requirements

* ✅ Install and run XAMPP (Apache + MySQL)
* ✅ Enable PHP and MySQL modules
* ✅ Import provided SQL tables for users, locations, contacts, feedback, etc.
* ✅ Access SafeWay locally via `localhost/SafeWay/`

---

## 📊 Sample Dashboard Visualizations

* **Bar Chart:** Crime incidents by area over the last 30 days.
* **Pie Chart:** Distribution of safety zones based on risk levels.
* **Line Chart:** Weekly frequency of safety tool usage.
* **Radar Chart:** Popularity of app features among users.
* **Bubble Chart:** Relation between user feedback, foot traffic, and safety scores.
* **Bar Chart:** Average emergency response times per area.

---

## 🚀 Future Enhancements (Planned)

| Feature                              | Status   |
| ------------------------------------ | -------- |
| 📱 Mobile Progressive Web App        | Planned  |
| 🤖 AI Crime Pattern Prediction       | Future   |
| 🌐 Integration of Live External APIs | Future   |
| 🔔 Real-Time Push Notifications      | Planned  |
| 🛰️ Automated Location & Sensor Data | Upcoming |

> *Note: The current release is a **manual-first MVP**, with all data maintained by admins to ensure accuracy and reliability.*

---

## 💡 Vision Statement

> *“SafeWay strives to be a trusted companion for women’s safety — blending clear, admin-verified data with interactive tools that empower confident movement in urban spaces.”*

---

## 📎 Typical Use Case

1. A user logs in and accesses the safety dashboard before heading out.
2. They explore the map to view safety ratings, crowd densities, and lighting status of nearby locations.
3. If a location shows high risk (poor lighting or dense crowds), the user can choose alternate safer routes.
4. In emergencies, the user taps the SOS button to alert trusted contacts with essential information.
5. Admins continuously update location safety data and monitor user feedback for improvements.

---

## 🗂️ Project Structure Overview

```
SafeWay/
│
├── assets/               # CSS, JavaScript, images, icons
├── backend/              # PHP scripts for managing data & users
│   ├── update_locations.php
│   ├── manage_feedback.php
│   └── handle_contacts.php
├── dashboard.php         # Visual analytics & charts
├── emergency.php         # Trusted contacts & SOS interface
├── index.php             # Landing/login page
├── map_explore.php       # Interactive safety map
├── profile.php           # User profile management
├── sql/                  # Database schema and sample data
└── README.md             # This file
```

---

## 🤝 Contributions

Contributions and suggestions are warmly welcomed! Whether it’s UI enhancements, better documentation, or new datasets, feel free to get in touch.

---

## 📬 Developer & Contact

* 🧑‍💻 Developer: **Abdullah AL Alam Shanto**
* 📧 Email: [abdullahshanto12.com](mailto:your.email@example.com)
* 🌐 Dedicated to improving women’s safety and confidence in public spaces.

---

Thank you for exploring SafeWay — where your safety is our mission! 🚺🛡️

---

