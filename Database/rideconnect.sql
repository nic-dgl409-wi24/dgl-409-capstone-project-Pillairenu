-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 09:06 PM
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
-- Database: `rideconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `ride_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `ride_id`, `passenger_id`, `booking_date`) VALUES
(1, 1, 4, '2024-02-26 06:10:27'),
(3, 2, 4, '2024-02-26 06:28:45'),
(5, 4, 4, '2024-02-26 18:23:56'),
(6, 4, 4, '2024-02-26 23:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `ride_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `arrival` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `seats_available` int(11) NOT NULL,
  `price_per_seat` decimal(10,2) NOT NULL,
  `additional_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`ride_id`, `user_id`, `departure`, `arrival`, `date`, `time`, `seats_available`, `price_per_seat`, `additional_notes`, `created_at`) VALUES
(1, 1, 'Comox', 'Courtenay', '2024-02-20', '08:17:00', 1, 4.00, '', '2024-02-26 03:16:15'),
(2, 3, '8th street', 'NIC', '2024-02-27', '08:30:00', 2, 5.00, '', '2024-02-26 04:30:50'),
(3, 5, 'walmart', 'costco', '2024-02-29', '11:31:00', 3, 8.00, '', '2024-02-26 04:31:49'),
(4, 8, 'Comox', 'NIC', '2024-02-15', '11:23:00', 2, 2.00, 'I&#39;m offering ride', '2024-02-26 18:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(3, 'admin'),
(1, 'driver'),
(2, 'passenger');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `gov_id_type` enum('passport','driving_license','national_id') NOT NULL,
  `gov_id_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `gender`, `dob`, `email`, `phone`, `password`, `profile_photo_path`, `gov_id_type`, `gov_id_path`, `created_at`, `updated_at`) VALUES
(1, 'driver1', 'female', '2024-02-01', 'driver1@gmail.com', '123456789', 'driver1', NULL, 'driving_license', NULL, '2024-02-24 08:08:54', '2024-02-24 08:08:54'),
(3, 'driver2', 'male', '2024-02-02', 'driver2@gmail.com', '123456789', 'driver2', NULL, 'national_id', 'drivermanagement.png', '2024-02-24 08:15:36', '2024-02-24 08:15:36'),
(4, 'passenger1', 'male', '2024-02-08', 'passenger1@gmail.com', '1234567', 'passenger1', '65d9ae4d6530b_person.png', 'national_id', '65d9ae4d656fa_drivermanagement.png', '2024-02-24 08:52:29', '2024-02-24 08:52:29'),
(5, 'driver3', 'female', '2024-02-08', 'driver3@gmail.com', '12345674567', 'driver3', NULL, 'driving_license', 'Document submission process.jpg', '2024-02-24 18:02:27', '2024-02-24 18:02:27'),
(8, 'driver4', 'female', '2024-02-06', 'driver4@gmail.com', '276576557432', 'driver4', NULL, 'driving_license', 'drivermanagement.png', '2024-02-26 18:21:13', '2024-02-26 18:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(4, 2),
(5, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_upload_path` varchar(255) DEFAULT NULL,
  `driving_experience` int(11) NOT NULL,
  `vehicle_make_model` varchar(255) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `insurance_doc_path` varchar(255) DEFAULT NULL,
  `vehicle_photo_path` varchar(255) DEFAULT NULL,
  `consent_background_check` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `user_id`, `license_upload_path`, `driving_experience`, `vehicle_make_model`, `vehicle_type`, `license_plate`, `insurance_doc_path`, `vehicle_photo_path`, `consent_background_check`, `created_at`) VALUES
(1, 1, 'Document submission process.jpg', 2, 'maruthi suzuki', 'suv', '121324325436', 'drivermanagement.png', 'car.png', 0, '2024-02-24 08:08:54'),
(3, 3, 'Document submission process.jpg', 2, 'maruthi suzuki', 'suv', '2133456789', 'drivermanagement.png', 'rideoffered.png', 0, '2024-02-24 08:15:36'),
(4, 5, 'drivermanagement.png', 2, 'maruthi suzuki', 'suv', '2133456785', 'event.png', 'drivermanagement.png', 0, '2024-02-24 18:02:27'),
(6, 8, 'drivermanagement.png', 3, 'maruthi suzuki', 'suv', '5454464747', 'car.png', 'car.png', 0, '2024-02-26 18:21:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `ride_id` (`ride_id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD UNIQUE KEY `license_plate` (`license_plate`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
