-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 07:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safeway`
--

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `scheduled_time` datetime NOT NULL,
  `status` enum('completed','failed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `user_id`, `phone_number`, `scheduled_time`, `status`, `created_at`) VALUES
(1, 101, '1234567890', '2025-05-05 10:30:00', 'completed', '2025-05-04 17:23:42'),
(2, 102, '9876543210', '2025-05-04 09:00:00', 'failed', '2025-05-04 17:23:42'),
(3, 101, '1112223333', '2025-05-06 14:15:00', 'completed', '2025-05-04 17:23:42'),
(4, 103, '4445556666', '2025-05-07 18:00:00', 'completed', '2025-05-04 17:23:42'),
(5, 104, '7778889999', '2025-05-03 20:45:00', 'completed', '2025-05-04 17:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `crime_stats`
--

CREATE TABLE `crime_stats` (
  `id` int(11) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `incidents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_stats`
--

INSERT INTO `crime_stats` (`id`, `area`, `incidents`) VALUES
(1, 'Gulshan', 34),
(2, 'Dhanmondi', 28),
(3, 'Mirpur', 40),
(4, 'Uttara', 22),
(5, 'Banani', 19),
(6, 'Badda', 25);

-- --------------------------------------------------------

--
-- Table structure for table `crime_type_trends`
--

CREATE TABLE `crime_type_trends` (
  `id` int(11) NOT NULL,
  `week` varchar(20) DEFAULT NULL,
  `theft` int(11) DEFAULT NULL,
  `harassment` int(11) DEFAULT NULL,
  `assault` int(11) DEFAULT NULL,
  `robbery` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_type_trends`
--

INSERT INTO `crime_type_trends` (`id`, `week`, `theft`, `harassment`, `assault`, `robbery`) VALUES
(1, 'Week 1', 5, 3, 4, 2),
(2, 'Week 2', 6, 2, 5, 3),
(3, 'Week 3', 7, 4, 3, 4),
(4, 'Week 4', 6, 3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_numbers`
--

CREATE TABLE `emergency_numbers` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_numbers`
--

INSERT INTO `emergency_numbers` (`id`, `title`, `phone_number`, `description`, `created_at`) VALUES
(1, 'Police', '100', 'Local police emergency line', '2025-05-04 17:24:12'),
(2, 'Ambulance', '102', 'For medical emergencies', '2025-05-04 17:24:12'),
(3, 'Fire Service', '101', 'Fire-related emergencies', '2025-05-04 17:24:12'),
(4, 'Women Helpline', '1091', 'Women safety support', '2025-05-04 17:24:12'),
(5, 'Cyber Crime', '1930', 'Report online threats or fraud', '2025-05-04 17:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_response`
--

CREATE TABLE `emergency_response` (
  `id` int(11) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_response`
--

INSERT INTO `emergency_response` (`id`, `area`, `time`) VALUES
(1, 'Gulshan', 5),
(2, 'Dhanmondi', 6),
(3, 'Mirpur', 8),
(4, 'Uttara', 7),
(5, 'Banani', 4);

-- --------------------------------------------------------

--
-- Table structure for table `feature_usage`
--

CREATE TABLE `feature_usage` (
  `id` int(11) NOT NULL,
  `feature` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature_usage`
--

INSERT INTO `feature_usage` (`id`, `feature`, `score`) VALUES
(1, 'Location Search', 85),
(2, 'Route Finder', 90),
(3, 'Emergency Contact', 95),
(4, 'Notification Alerts', 80),
(5, 'Panic Button', 88);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_bubble`
--

CREATE TABLE `feedback_bubble` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `feedback_pos` int(11) DEFAULT NULL,
  `safety_score` int(11) DEFAULT NULL,
  `traffic_size` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_bubble`
--

INSERT INTO `feedback_bubble` (`id`, `label`, `feedback_pos`, `safety_score`, `traffic_size`) VALUES
(1, 'Gulshan', 85, 78, 0.6),
(2, 'Mirpur', 70, 65, 0.8),
(3, 'Dhanmondi', 90, 82, 0.7);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `safety_score` float DEFAULT NULL,
  `hospitals` text DEFAULT NULL,
  `police_stations` text DEFAULT NULL,
  `crime_trend` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `area_name`, `safety_score`, `hospitals`, `police_stations`, `crime_trend`) VALUES
(1, 'Gulshan', 9.2, 'United Hospital, Evercare Hospital', 'Gulshan Police Station, Banani Police Station', 'Low and decreasing'),
(2, 'Dhanmondi', 8.5, 'Popular Diagnostic, LabAid Hospital', 'Dhanmondi Police Station', 'Moderate and stable'),
(3, 'Mirpur', 6.8, 'Dhaka Dental College, National Heart Foundation', 'Pallabi Police Station, Mirpur Model Police Station', 'High and fluctuating'),
(4, 'Uttara', 8.7, 'Lubana General Hospital, Uttara Crescent Hospital', 'Uttara West Police Station, Uttara East Police Station', 'Low and stable'),
(5, 'Motijheel', 7.5, 'Islamia Eye Hospital, Kakrail General Hospital', 'Motijheel Police Station', 'Moderate and decreasing'),
(6, 'Mohammadpur', 7, 'Mohammadpur Central Hospital', 'Mohammadpur Police Station', 'Moderate and rising'),
(7, 'Badda', 6.2, 'Badda General Hospital', 'Badda Police Station', 'High and rising'),
(8, 'Tejgaon', 7.8, 'Tejgaon Industrial Hospital', 'Tejgaon Police Station', 'Low and steady'),
(9, 'Shahbagh', 8.3, 'PG Hospital, Bangabandhu Medical University', 'Shahbagh Police Station', 'Low and declining'),
(10, 'Rampura', 6.5, 'Rampura General Hospital', 'Rampura Police Station', 'Moderate and unstable'),
(11, 'Banani', 9, 'Banani General Hospital', 'Banani Police Station', 'Low and decreasing'),
(12, 'Khilgaon', 7.2, 'Khilgaon General Hospital', 'Khilgaon Police Station', 'Moderate and stable'),
(13, 'Kotwali', 8, 'Sadarghat General Hospital', 'Kotwali Police Station', 'Low and declining'),
(14, 'Rajarbagh', 7.3, 'Rajarbagh Police Hospital', 'Rajarbagh Police Station', 'Moderate and fluctuating'),
(15, 'Savar', 8.4, 'Savar Hospital', 'Savar Police Station', 'Low and stable'),
(16, 'Narayanganj', 7.6, 'Narayanganj General Hospital', 'Narayanganj Police Station', 'Moderate and rising'),
(17, 'Manikganj', 8.2, 'Manikganj Hospital', 'Manikganj Police Station', 'Low and steady'),
(18, 'Gazipur', 7.9, 'Gazipur City Hospital', 'Gazipur Police Station', 'Moderate and fluctuating'),
(19, 'Tongi', 6.9, 'Tongi General Hospital', 'Tongi Police Station', 'High and increasing'),
(20, 'Ashulia', 7.4, 'Ashulia General Hospital', 'Ashulia Police Station', 'Moderate and decreasing');

-- --------------------------------------------------------

--
-- Table structure for table `medical_info`
--

CREATE TABLE `medical_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_info`
--

INSERT INTO `medical_info` (`id`, `user_id`, `blood_type`, `allergies`, `medical_conditions`, `medications`, `emergency_contact_name`, `emergency_contact_phone`, `created_at`, `updated_at`) VALUES
(0, 9, 'O+', 'Peanuts', 'Asthma', 'Inhaler', 'Mom', '1234567890', '2025-05-04 17:33:19', '2025-05-04 17:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `message_history`
--

CREATE TABLE `message_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_history`
--

INSERT INTO `message_history` (`id`, `user_id`, `message_text`, `created_at`) VALUES
(1, 101, 'Emergency alert sent to Mom', '2025-05-04 17:24:47'),
(2, 102, 'Location shared with Best Friend', '2025-05-04 17:24:47'),
(3, 103, 'Scheduled call reminder sent', '2025-05-04 17:24:47'),
(4, 104, 'Medication alert sent to Neighbor', '2025-05-04 17:24:47'),
(5, 105, 'All trusted contacts notified', '2025-05-04 17:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `urgency` varchar(50) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `location`, `category`, `urgency`, `link`, `timestamp`) VALUES
(1, 'Road Block in Gulshan', 'There is a major road block due to an accident near Gulshan-1.', 'Gulshan', 'Traffic', 'High', 'http://example.com/roadblock-gulshan', '2025-05-04 08:00:00'),
(2, 'Police Alert in Dhanmondi', 'Police are conducting a security check in Dhanmondi area.', 'Dhanmondi', 'Security', 'Medium', 'http://example.com/police-dhanmondi', '2025-05-04 09:15:00'),
(3, 'Market Closed in Mirpur', 'Mirpur market will be closed today due to ongoing maintenance work.', 'Mirpur', 'Public Notice', 'Low', 'http://example.com/market-mirpur', '2025-05-04 10:30:00'),
(4, 'Traffic Jam in Uttara', 'Heavy traffic reported on Airport Road in Uttara due to construction work.', 'Uttara', 'Traffic', 'High', 'http://example.com/traffic-uttara', '2025-05-04 11:45:00'),
(5, 'Power Outage in Motijheel', 'A planned power outage will occur in Motijheel from 12 PM to 4 PM.', 'Motijheel', 'Utilities', 'Medium', 'http://example.com/power-outage-motijheel', '2025-05-04 12:00:00'),
(6, 'Flood Warning in Mohammadpur', 'Flood warning has been issued for Mohammadpur and nearby areas.', 'Mohammadpur', 'Weather', 'High', 'http://example.com/flood-warning-mohammadpur', '2025-05-04 12:30:00'),
(7, 'Streetlight Repair in Badda', 'Streetlights in Badda are being repaired tonight, please be cautious.', 'Badda', 'Maintenance', 'Low', 'http://example.com/streetlight-badda', '2025-05-04 13:00:00'),
(8, 'New Hospital Opening in Tejgaon', 'Tejgaon Industrial Hospital is opening a new emergency department today.', 'Tejgaon', 'Event', 'Medium', 'http://example.com/hospital-tejgaon', '2025-05-04 14:00:00'),
(9, 'Crime Alert in Shahbagh', 'There was a robbery incident reported in Shahbagh area, please stay cautious.', 'Shahbagh', 'Crime', 'High', 'http://example.com/crime-shahbagh', '2025-05-04 14:30:00'),
(10, 'Road Closed in Rampura', 'Rampura road is closed for maintenance work until further notice.', 'Rampura', 'Traffic', 'Medium', 'http://example.com/road-closed-rampura', '2025-05-04 15:00:00'),
(11, 'Security Check in Banani', 'There will be an increased police presence in Banani for a routine security check.', 'Banani', 'Security', 'Low', 'http://example.com/security-banani', '2025-05-04 15:30:00'),
(12, 'Noise Pollution in Khilgaon', 'There is ongoing construction work in Khilgaon causing significant noise pollution.', 'Khilgaon', 'Environmental', 'Low', 'http://example.com/noise-khilgaon', '2025-05-04 16:00:00'),
(13, 'Protest in Kotwali', 'A peaceful protest is happening in Kotwali, please avoid the area if possible.', 'Kotwali', 'Event', 'Medium', 'http://example.com/protest-kotwali', '2025-05-04 16:30:00'),
(14, 'Bank Strike in Rajarbagh', 'Bank employees are on strike in Rajarbagh, affecting services in the area.', 'Rajarbagh', 'Labor', 'Medium', 'http://example.com/bank-strike-rajarbagh', '2025-05-04 17:00:00'),
(15, 'New Mall Opening in Savar', 'The new shopping mall in Savar will have its grand opening this weekend.', 'Savar', 'Event', 'Low', 'http://example.com/mall-savar', '2025-05-04 17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `notification_engagement`
--

CREATE TABLE `notification_engagement` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `clicked` int(11) DEFAULT NULL,
  `dismissed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_engagement`
--

INSERT INTO `notification_engagement` (`id`, `type`, `viewed`, `clicked`, `dismissed`) VALUES
(1, 'Crime Alert', 100, 60, 10),
(2, 'Weather Alert', 80, 50, 5),
(3, 'Route Safety', 90, 55, 8);

-- --------------------------------------------------------

--
-- Table structure for table `route_requests`
--

CREATE TABLE `route_requests` (
  `id` int(11) NOT NULL,
  `start_location` varchar(255) DEFAULT NULL,
  `end_location` varchar(255) DEFAULT NULL,
  `time_of_day` varchar(50) DEFAULT NULL,
  `travel_mode` varchar(50) DEFAULT NULL,
  `companion_status` varchar(50) DEFAULT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `safety_checks`
--

CREATE TABLE `safety_checks` (
  `id` int(11) NOT NULL,
  `day` varchar(15) DEFAULT NULL,
  `checks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_checks`
--

INSERT INTO `safety_checks` (`id`, `day`, `checks`) VALUES
(1, 'Monday', 120),
(2, 'Tuesday', 135),
(3, 'Wednesday', 150),
(4, 'Thursday', 170),
(5, 'Friday', 190);

-- --------------------------------------------------------

--
-- Table structure for table `safety_data`
--

CREATE TABLE `safety_data` (
  `id` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `safety_score` int(11) DEFAULT NULL,
  `police_stations` text DEFAULT NULL,
  `weather_advisory` text DEFAULT NULL,
  `crowd_density` varchar(50) DEFAULT NULL,
  `incidents` text DEFAULT NULL,
  `transport_scores` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_data`
--

INSERT INTO `safety_data` (`id`, `area`, `lat`, `lon`, `safety_score`, `police_stations`, `weather_advisory`, `crowd_density`, `incidents`, `transport_scores`) VALUES
(1, 'Dhanmondi', 23.7465, 90.376, 75, '[\"Dhanmondi Thana – 1.2km\", \"New Market Police Box – 2.1km\", \"Lalmatia Police Post – 2.9km\"]', 'It might rain in the evening. Carry an umbrella. Avoid slippery footpaths.', 'Medium', '[\"Pickpocketing near Mirpur Road – 2 days ago\", \"Suspicious activity in Kalabagan – 5 days ago\", \"Street harassment near Science Lab – 6 days ago\"]', '{\"Buses in Dhanmondi\":\"Safe (Score: 82)\", \"Rickshaws in Lalmatia\":\"Moderate (Score: 57)\"}'),
(2, 'Gulshan', 23.7925, 90.4078, 85, '[\"Gulshan Model Thana – 1.1km\", \"Banani Police Box – 2.0km\"]', 'Clear skies expected. Good to go.', 'Low', '[\"Theft near Gulshan Circle 2 – 4 days ago\", \"Unauthorized gathering reported – 6 days ago\"]', '{\"Ride-sharing cars\":\"Safe (Score: 90)\", \"CNGs\":\"Moderate (Score: 60)\"}'),
(3, 'Mirpur', 23.8041, 90.3667, 55, '[\"Mirpur Model Thana – 0.9km\", \"Shialbari Police Outpost – 1.8km\"]', 'Dust in the air. Consider wearing a mask.', 'High', '[\"Pickpocketing near Zoo Road – 1 day ago\", \"Bike snatching near Section 10 – 3 days ago\"]', '{\"Buses\":\"Moderate (Score: 60)\", \"CNGs\":\"Low (Score: 45)\"}'),
(4, 'Uttara', 23.8747, 90.3984, 78, '[\"Uttara West Police Station – 1.3km\", \"House Building Police Box – 2.2km\"]', 'Possible thunderstorms in the afternoon. Be cautious.', 'Medium', '[\"Eve teasing reported in Sector 7 – 2 days ago\"]', '{\"Metro Rail\":\"Very Safe (Score: 95)\", \"Buses\":\"Safe (Score: 80)\"}'),
(5, 'Mohammadpur', 23.76, 90.358, 62, '[\"Mohammadpur Police Station – 1.5km\", \"Asad Gate Outpost – 2.0km\"]', 'Light rain expected. Carry an umbrella.', 'Medium', '[\"Robbery near Town Hall – 3 days ago\", \"Fight near Salimullah Road – 4 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 58)\", \"Buses\":\"Low (Score: 49)\"}'),
(6, 'Badda', 23.7806, 90.4244, 48, '[\"Badda Police Station – 1.1km\", \"Rampura Police Box – 1.9km\"]', 'Heavy rain predicted. Roads may be slippery.', 'High', '[\"Snatching incident near Badda Link Road – 1 day ago\", \"Vandalism reported – 3 days ago\"]', '{\"CNGs\":\"Low (Score: 40)\", \"Buses\":\"Low (Score: 38)\"}'),
(7, 'Motijheel', 23.7333, 90.4178, 70, '[\"Motijheel Thana – 0.8km\", \"Shapla Chattar Police Post – 1.4km\"]', 'Clear weather. No major alerts.', 'Medium', '[\"Fraud reported in commercial bank – 2 days ago\"]', '{\"Office Shuttles\":\"Safe (Score: 83)\", \"CNGs\":\"Moderate (Score: 55)\"}'),
(8, 'Tejgaon', 23.7576, 90.3928, 67, '[\"Tejgaon Industrial Police Station – 1.0km\", \"Agargaon Police Outpost – 1.5km\"]', 'Possible drizzle after 7 PM.', 'Medium', '[\"Factory accident reported – 5 days ago\", \"Unauthorized protest – 2 days ago\"]', '{\"Ride-sharing bikes\":\"Moderate (Score: 62)\", \"Buses\":\"Moderate (Score: 59)\"}'),
(9, 'Kalabagan', 23.7489, 90.3793, 60, '[\"Kalabagan Police Box – 0.9km\", \"Science Lab Outpost – 1.3km\"]', 'Partly cloudy, no rain forecast.', 'Medium', '[\"Eve teasing near Lake Circus – 1 day ago\", \"Attempted snatch near bus stop – 2 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 55)\", \"Buses\":\"Low (Score: 42)\"}'),
(10, 'Banani', 23.7916, 90.4043, 82, '[\"Banani Police Station – 1.0km\", \"Chairman Bari Outpost – 2.0km\"]', 'Pleasant weather today.', 'Low', '[\"Street altercation near Road 27 – 4 days ago\"]', '{\"Ride-sharing cars\":\"Very Safe (Score: 93)\", \"CNGs\":\"Safe (Score: 75)\"}'),
(11, 'Banani', 23.7916, 90.4043, 82, '[\"Banani Police Station – 1.0km\", \"Chairman Bari Outpost – 2.0km\"]', 'Pleasant weather today.', 'Low', '[\"Street altercation near Road 27 – 4 days ago\"]', '{\"Ride-sharing cars\":\"Very Safe (Score: 93)\", \"CNGs\":\"Safe (Score: 75)\"}'),
(12, 'Khilgaon', 23.7554, 90.4056, 68, '[\"Khilgaon Police Station – 1.0km\", \"Khilgaon Chowdhury Police Box – 1.8km\"]', 'Light rain expected in the evening.', 'Medium', '[\"Burglary near Khilgaon Road – 2 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 60)\", \"Buses\":\"Low (Score: 45)\"}'),
(13, 'Tongi', 23.8775, 90.3716, 55, '[\"Tongi Police Station – 1.3km\", \"Bodur Bagan Police Outpost – 2.1km\"]', 'Heavy rain expected in the afternoon. Carry an umbrella.', 'High', '[\"Robbery near Tongi Station – 1 day ago\", \"Fight near Bazaar Road – 3 days ago\"]', '{\"CNGs\":\"Low (Score: 48)\", \"Buses\":\"Low (Score: 40)\"}'),
(14, 'Narayanganj', 23.6225, 90.502, 70, '[\"Narayanganj Police Station – 1.5km\", \"Narayanganj Bazar Police Post – 2.3km\"]', 'Partly cloudy with no rain forecast.', 'Medium', '[\"Snatching reported at the Market – 2 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 55)\", \"Buses\":\"Moderate (Score: 50)\"}'),
(15, 'Gazipur', 23.8474, 90.415, 65, '[\"Gazipur Police Station – 1.2km\", \"Gazipur City Corporation Police Box – 2.5km\"]', 'Clear skies expected. Safe for travel.', 'Low', '[\"Pickpocketing near Gazipur Bazar – 3 days ago\"]', '{\"CNGs\":\"Safe (Score: 75)\", \"Buses\":\"Moderate (Score: 60)\"}'),
(16, 'Savar', 23.8756, 90.3031, 72, '[\"Savar Police Station – 1.4km\", \"Nabinagar Police Box – 2.0km\"]', 'Overcast with light rain later in the evening.', 'Medium', '[\"Suspicious vehicle parked near Savar Bazar – 2 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 58)\", \"Buses\":\"Safe (Score: 70)\"}'),
(17, 'Ashulia', 23.8656, 90.3154, 68, '[\"Ashulia Police Station – 1.1km\", \"Ashulia Industrial Police Outpost – 2.2km\"]', 'Expected thunderstorms, stay indoors if possible.', 'High', '[\"Street harassment near Ashulia Bazar – 1 day ago\"]', '{\"Rickshaws\":\"Low (Score: 45)\", \"Buses\":\"Moderate (Score: 60)\"}'),
(18, 'Mirpur-10', 23.8022, 90.3638, 60, '[\"Mirpur Model Police Station – 0.5km\", \"Pallabi Police Station – 1.8km\"]', 'Partly cloudy, no rain forecast.', 'Medium', '[\"Robbery near Mirpur-10 – 4 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 55)\", \"CNGs\":\"Low (Score: 50)\"}'),
(19, 'Moghbazar', 23.7597, 90.3961, 74, '[\"Moghbazar Police Station – 1.0km\", \"Banglamotor Police Post – 2.0km\"]', 'Clear skies expected. Good weather for outdoor activities.', 'Low', '[\"Snatching incident near Moghbazar Circle – 5 days ago\"]', '{\"CNGs\":\"Safe (Score: 85)\", \"Buses\":\"Moderate (Score: 60)\"}'),
(20, 'Shyamoli', 23.7707, 90.3573, 64, '[\"Shyamoli Police Station – 1.2km\", \"Khamar Bari Police Box – 2.3km\"]', 'Possible drizzle later in the day.', 'Medium', '[\"Attempted robbery near Shyamoli Bus Stand – 3 days ago\"]', '{\"Rickshaws\":\"Moderate (Score: 58)\", \"Buses\":\"Low (Score: 42)\"}');

-- --------------------------------------------------------

--
-- Table structure for table `safety_distribution`
--

CREATE TABLE `safety_distribution` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_distribution`
--

INSERT INTO `safety_distribution` (`id`, `label`, `value`) VALUES
(1, 'Safe', 45),
(2, 'Moderate', 35),
(3, 'Unsafe', 20);

-- --------------------------------------------------------

--
-- Table structure for table `safety_ratings`
--

CREATE TABLE `safety_ratings` (
  `id` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `area_type` varchar(100) DEFAULT NULL,
  `reported_incidents` int(11) DEFAULT NULL,
  `safety_rating` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_ratings`
--

INSERT INTO `safety_ratings` (`id`, `location`, `latitude`, `longitude`, `area_type`, `reported_incidents`, `safety_rating`, `notes`) VALUES
(1, 'Gulshan', 23.7925, 90.4078, 'Residential', 3, 'High', 'Well-lit, security patrols'),
(2, 'Mirpur', 23.8041, 90.3665, 'Mixed', 10, 'Medium', 'Moderate activity at night'),
(3, 'Uttara', 23.8759, 90.3795, 'Residential', 4, 'High', 'Safe and monitored'),
(4, 'Farmgate', 23.7568, 90.3885, 'Commercial', 15, 'Low', 'High crowd density'),
(5, 'Dhanmondi', 23.7461, 90.3748, 'Mixed', 6, 'Medium', 'Some isolated areas'),
(6, 'Old Dhaka', 23.7099, 90.4071, 'Dense Residential', 18, 'Low', 'Poor street lighting'),
(7, 'Banani', 23.7936, 90.4007, 'Commercial', 5, 'Medium', 'Generally safe, but avoid late hours'),
(8, 'Mohakhali', 23.7803, 90.4006, 'Commercial', 7, 'Medium', 'Busy during day, caution at night'),
(9, 'Badda', 23.7806, 90.4266, 'Residential', 9, 'Low', 'Reports of theft, poor lighting'),
(10, 'Tejgaon', 23.7598, 90.3925, 'Industrial', 6, 'Medium', 'Limited pedestrian presence'),
(11, 'Shantinagar', 23.737, 90.414, 'Mixed', 3, 'High', 'Active neighborhood watch'),
(12, 'Motijheel', 23.7325, 90.4142, 'Commercial', 12, 'Low', 'Busy hub, prone to petty crimes'),
(13, 'Khilgaon', 23.7554, 90.4056, 'Residential', 8, 'Medium', 'Moderate crowd density, some thefts reported'),
(14, 'Savar', 23.8756, 90.3031, 'Suburban', 4, 'High', 'Safe and peaceful, good street lighting'),
(15, 'Gazipur', 23.8474, 90.415, 'Suburban', 5, 'Medium', 'Low crime rate, some areas less monitored'),
(16, 'Ashulia', 23.8656, 90.3154, 'Industrial', 7, 'Low', 'Occasional accidents, some areas poorly lit'),
(17, 'Narayanganj', 23.6225, 90.502, 'Mixed', 9, 'Medium', 'High traffic, occasional petty thefts'),
(18, 'Tongi', 23.8775, 90.3716, 'Suburban', 10, 'Low', 'Some isolated incidents, poor street lighting'),
(19, 'Moghbazar', 23.7597, 90.3961, 'Commercial', 5, 'High', 'Generally safe with high police presence'),
(20, 'Shyamoli', 23.7707, 90.3573, 'Residential', 6, 'Medium', 'Some petty crimes, better safety at night');

-- --------------------------------------------------------

--
-- Table structure for table `safety_zones`
--

CREATE TABLE `safety_zones` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `patrolling` varchar(100) DEFAULT NULL,
  `streetLighting` varchar(100) DEFAULT NULL,
  `incidentReports` text DEFAULT NULL,
  `womenHelpline` varchar(100) DEFAULT NULL,
  `transportAccess` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safety_zones`
--

INSERT INTO `safety_zones` (`id`, `name`, `latitude`, `longitude`, `level`, `patrolling`, `streetLighting`, `incidentReports`, `womenHelpline`, `transportAccess`, `description`, `color`) VALUES
(1, 'Gulshan 2', 23.7916, 90.4152, 'High', 'Frequent', 'Excellent', 'Low', 'Active Booth', 'High (CNG, ride-sharing)', 'Upscale diplomatic area with tight security', 'green'),
(2, 'Mirpur 10', 23.8065, 90.3681, 'Moderate', 'Moderate', 'Adequate', 'Occasional petty theft', 'Nearby police box', 'High (metro, buses)', 'Busy area, safe in day, stay alert at night', 'orange'),
(3, 'Uttara', 23.8759, 90.3795, 'High', 'Frequent', 'Excellent', 'Low', 'Active Booth', 'High (CNG, ride-sharing)', 'Upscale diplomatic area with tight security', 'green'),
(4, 'Khilkhet', 23.8311, 90.4243, 'Moderate', 'Moderate', 'Adequate', 'Occasional petty theft', 'Nearby police box', 'High (metro, buses)', 'Busy area, safe in day, stay alert at night', 'orange'),
(5, 'Farmgate', 23.7574, 90.3911, 'Moderate', 'Moderate', 'Average', 'Pickpocketing in crowds', 'Moderate response', 'Very High', 'Congested but central; crowded areas require alertness', 'orange'),
(6, 'Moghbazar', 23.7415, 90.4062, 'Low', 'Low', 'Poor', 'Harassment reported', 'Weak presence', 'Moderate', 'Some alleys unsafe, avoid walking alone late night', 'red'),
(7, 'Dhanmondi 27', 23.7464, 90.3732, 'High', 'High', 'Good', 'Minimal', 'Active', 'Good', 'Well-regulated residential & educational zone', 'green'),
(8, 'Mohakhali Bus Terminal', 23.7775, 90.4028, 'Low', 'Low', 'Dim', 'Frequent scams', 'Scattered presence', 'Very High', 'Major transit hub; crowded and chaotic', 'red'),
(9, 'Banani', 23.7925, 90.4043, 'Moderate', 'Regular', 'Satisfactory', 'Low after midnight', 'Nearby police patrol', 'Good', 'Mixed residential and nightlife area', 'orange'),
(10, 'Tejgaon', 23.755, 90.392, 'Moderate', 'Moderate', 'Average', 'Workplace harassment', 'Limited booths', 'High (offices and buses)', 'Industrial zone; relatively safe during work hours', 'orange'),
(11, 'Badda', 23.7808, 90.4268, 'Low', 'Low', 'Poor', 'Snatching reported', 'Weak presence', 'Moderate', 'Crowded but lacks adequate safety measures at night', 'red'),
(12, 'Shyamoli', 23.774, 90.3595, 'Moderate', 'Regular', 'Fair', 'Petty theft at night', 'Occasional patrol', 'High (buses, rickshaws)', 'Residential area, avoid dark alleys', 'orange'),
(13, 'Motijheel', 23.7326, 90.4174, 'Moderate', 'High', 'Bright', 'Rare incidents', 'Nearby booths', 'Very High (offices and transport)', 'Financial hub with good security during work hours', 'orange'),
(14, 'Rampura', 23.7548, 90.4269, 'Low', 'Rare', 'Dim', 'Assaults reported', 'No booths nearby', 'Moderate (rickshaws, local buses)', 'Narrow lanes and poor visibility at night', 'red'),
(15, 'Lalmatia', 23.75, 90.37, 'High', 'Regular', 'Excellent', 'Very low', 'Well-connected booths', 'Good (CNG, cycle rickshaw)', 'Quiet residential area with good lighting and security', 'green'),
(16, 'Mohammadpur', 23.7642, 90.3667, 'Moderate', 'Moderate', 'Adequate', 'Occasional theft', 'Nearby police box', 'Moderate (rickshaws, buses)', 'Residential area with some busy zones, stay alert at night', 'orange'),
(17, 'Gulshan 1', 23.7836, 90.4069, 'High', 'Frequent', 'Excellent', 'Low', 'Active Booth', 'High (CNG, ride-sharing)', 'Upscale area with good police presence and high security', 'green'),
(18, 'Banani DOHS', 23.79, 90.4113, 'High', 'Frequent', 'Excellent', 'Very low', 'Active Booth', 'High (ride-sharing, CNG)', 'Residential area with good lighting and security patrols', 'green'),
(19, 'Bashundhara', 23.7945, 90.4138, 'High', 'Frequent', 'Good', 'Low', 'Active Booth', 'Very High (CNG, ride-sharing)', 'Commercial and residential zone with strong security measures', 'green'),
(20, 'Puran Dhaka', 23.71, 90.41, 'Low', 'Low', 'Poor', 'High crime rate', 'Weak presence', 'Low (local transport)', 'Historical area with some unsafe spots, especially at night', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_calls`
--

CREATE TABLE `scheduled_calls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `scheduled_time` datetime NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduled_calls`
--

INSERT INTO `scheduled_calls` (`id`, `user_id`, `phone_number`, `scheduled_time`, `status`, `created_at`) VALUES
(0, 9, '1234567890', '2025-05-05 15:00:00', 'pending', '2025-05-04 17:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `trustednumbers`
--

CREATE TABLE `trustednumbers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `special_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trustednumbers`
--

INSERT INTO `trustednumbers` (`id`, `user_id`, `title`, `phone_number`, `special_note`, `created_at`) VALUES
(0, 9, 'Mom', '1234567890', 'Always answers calls', '2025-05-04 17:28:11'),
(0, 9, 'Best Friend', '9876543210', 'Lives nearby', '2025-05-04 17:28:38'),
(0, 9, 'Dad', '1112223333', 'Emergency only', '2025-05-04 17:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`) VALUES
(9, 'Abdullah Shanto', 'abdullah@gmail.com', '$2y$10$gCQZEb1U5Dpy8gkQXZBfYe6dvXI5FnCVeQ0aTCHhAt5srBadIpypy', 'Students');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime_stats`
--
ALTER TABLE `crime_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_type_trends`
--
ALTER TABLE `crime_type_trends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_response`
--
ALTER TABLE `emergency_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_usage`
--
ALTER TABLE `feature_usage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_bubble`
--
ALTER TABLE `feedback_bubble`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_engagement`
--
ALTER TABLE `notification_engagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_requests`
--
ALTER TABLE `route_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_checks`
--
ALTER TABLE `safety_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_data`
--
ALTER TABLE `safety_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_distribution`
--
ALTER TABLE `safety_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_ratings`
--
ALTER TABLE `safety_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_zones`
--
ALTER TABLE `safety_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crime_stats`
--
ALTER TABLE `crime_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crime_type_trends`
--
ALTER TABLE `crime_type_trends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency_response`
--
ALTER TABLE `emergency_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feature_usage`
--
ALTER TABLE `feature_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback_bubble`
--
ALTER TABLE `feedback_bubble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification_engagement`
--
ALTER TABLE `notification_engagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `route_requests`
--
ALTER TABLE `route_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `safety_checks`
--
ALTER TABLE `safety_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `safety_data`
--
ALTER TABLE `safety_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `safety_distribution`
--
ALTER TABLE `safety_distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `safety_ratings`
--
ALTER TABLE `safety_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `safety_zones`
--
ALTER TABLE `safety_zones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
