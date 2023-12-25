-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 07:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_managment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(11) NOT NULL,
  `disease_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `disease_name`, `is_active`) VALUES
(1, 'HVC ', 1),
(2, 'blood presure', 1),
(3, 'm', 1),
(4, 'Flue test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab_tests`
--

INSERT INTO `lab_tests` (`id`, `test_name`, `is_active`) VALUES
(1, 'x ray ', 0),
(2, 'blood test dfd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine_name`, `is_active`) VALUES
(1, 'anabol asid', 0),
(2, 'panadol', 1),
(3, 'test QQ', 1),
(4, 'anabol', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_details`
--

CREATE TABLE `medicine_details` (
  `id` int(11) NOT NULL,
  `medicien_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `packing` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine_details`
--

INSERT INTO `medicine_details` (`id`, `medicien_id`, `is_active`, `packing`) VALUES
(1, 1, 0, '5mg'),
(2, 1, 1, '9mg'),
(3, 1, 1, '233mg'),
(4, 2, 1, '200mg');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `contact`, `gender`, `address`) VALUES
(1, 'khan', '44', '30293493209', 'female', 'peshawar'),
(2, 'aliza shah', '44', '30293493209', 'female', 'lahore'),
(3, 'shakir', '23', '043433434343', 'male ', 'lahore ');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visits`
--

CREATE TABLE `patient_visits` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `blood_presure` varchar(100) NOT NULL,
  `suger` varchar(100) NOT NULL,
  `next_visit_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_visits`
--

INSERT INTO `patient_visits` (`id`, `patient_id`, `date`, `blood_presure`, `suger`, `next_visit_date`, `created_by`, `created_at`) VALUES
(3, 2, '2023-12-17', '120/190', '430', '2023-12-22', 15, '2023-12-17 07:28:57'),
(4, 1, '2023-12-17', '342/454`', '100', '2023-12-01', 15, '2023-12-17 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visit_diseases`
--

CREATE TABLE `patient_visit_diseases` (
  `id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_visit_diseases`
--

INSERT INTO `patient_visit_diseases` (`id`, `patient_visit_id`, `disease_id`, `created_by`, `created_at`) VALUES
(1, 3, 2, 15, '2023-12-17 07:28:57'),
(2, 3, 4, 15, '2023-12-17 07:28:57'),
(3, 3, 1, 15, '2023-12-17 07:28:57'),
(4, 4, 1, 15, '2023-12-17 07:33:00'),
(5, 4, 2, 15, '2023-12-17 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visit_medications`
--

CREATE TABLE `patient_visit_medications` (
  `id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL,
  `medicien_detail_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `dosage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_visit_medications`
--

INSERT INTO `patient_visit_medications` (`id`, `patient_visit_id`, `medicien_detail_id`, `created_by`, `created_at`, `quantity`, `dosage`) VALUES
(1, 3, 1, 15, '2023-12-17 07:28:57', 2, '2'),
(2, 3, 4, 15, '2023-12-17 07:28:57', 1, '3'),
(3, 3, 3, 15, '2023-12-17 07:28:57', 1, '4'),
(4, 4, 1, 15, '2023-12-17 07:33:00', 222, '12'),
(5, 4, 1, 15, '2023-12-17 07:33:00', 222, '12');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visit_tests`
--

CREATE TABLE `patient_visit_tests` (
  `id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `test_result` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_visit_tests`
--

INSERT INTO `patient_visit_tests` (`id`, `patient_visit_id`, `lab_test_id`, `test_result`) VALUES
(1, 4, 1, 'not good');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `full_name`, `user_name`, `email`, `password`, `is_active`, `created_at`, `profile_picture`) VALUES
(5, 29, 'sheryar', 'shery11223', '1215sheryarkhan@gmail.com', 'ab', 1, NULL, NULL),
(6, 27, 'sheryar khan', 'sheryar', '1215sheryarkhan@gmail.com', '323232', NULL, '2023-11-09 05:59:13', NULL),
(7, 27, 'abc', 'abc', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 1, '2023-11-09 06:01:49', NULL),
(8, 29, 'khan', '33khan', '1215sheryarkhan@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '2023-11-09 06:45:28', '1699508728_users_images_pmsjpg'),
(9, 27, 'Wajid ', 'admin', '1215sheryarkhan@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 1, '2023-11-09 06:47:58', '1699508878_users_images_pms.webp'),
(10, 29, 'sheryar khan', 'admin', '1215sheryarkhan@gmail.com', '343b1c4a3ea721b2d640fc8700db0f36', 1, '2023-11-09 06:49:06', '1699508946_users_images_pms.jpg'),
(11, 27, 'test', 'setegts', 'sdsfds@gmail.com', '28b662d883b6d76fd96e4ddc5e9ba780', 1, '2023-11-09 06:54:49', '1699509289_users_images_pms.jpg'),
(12, 28, 'ali khan', 'ali221', '1215sheryarkhan@gmail.com', 'a384b6463fc216a5f8ecb6670f86456a', 0, '2023-11-12 13:39:47', '1699792787_users_images_pms.jpg'),
(13, 28, 'sheryar khan', 'sheryar1', '1215sheryarkhan@gmail.com', '9e3669d19b675bd57058fd4664205d2a', 1, '2023-11-12 16:47:45', '1699804065_users_images_pms.jpg'),
(14, 27, 'a', 'a', '1215sheryarkhan@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 1, '2023-11-13 15:17:07', '1699885027_users_images_pms.jpg'),
(15, 28, 'sheryar', 'shery1', '1215sheryarkhan@gmail.com', 'f970e2767d0cfe75876ea857f92e319b', 1, '2023-11-13 16:42:36', '1699890156_users_images_pms.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `is_active`) VALUES
(27, 'Pharmacist', 1),
(28, 'Owner', 1),
(29, 'Doctor', 1),
(30, 'Accountant', 1),
(31, 'Manager', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_details`
--
ALTER TABLE `medicine_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medicine_details_medicien_id` (`medicien_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_visits_patient_id` (`patient_id`),
  ADD KEY `fk_patient_visits_created_by` (`created_by`);

--
-- Indexes for table `patient_visit_diseases`
--
ALTER TABLE `patient_visit_diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_visit_diseases_patient_visit_id` (`patient_visit_id`),
  ADD KEY `fk_patient_visit_diseases_diseases_id` (`disease_id`),
  ADD KEY `fk_patient_visit_diseases_created_by` (`created_by`);

--
-- Indexes for table `patient_visit_medications`
--
ALTER TABLE `patient_visit_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_visit_medications_patient_visit_id` (`patient_visit_id`),
  ADD KEY `fk_patient_visit_medications_medicien_detail_id` (`medicien_detail_id`),
  ADD KEY `fk_patient_visit_medicaton_created_by` (`created_by`);

--
-- Indexes for table `patient_visit_tests`
--
ALTER TABLE `patient_visit_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_visit_tests_patient_visit_id` (`patient_visit_id`),
  ADD KEY `fk_patient_visit_tests_lab_test_id` (`lab_test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine_details`
--
ALTER TABLE `medicine_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_visits`
--
ALTER TABLE `patient_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_visit_diseases`
--
ALTER TABLE `patient_visit_diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_visit_medications`
--
ALTER TABLE `patient_visit_medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_visit_tests`
--
ALTER TABLE `patient_visit_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine_details`
--
ALTER TABLE `medicine_details`
  ADD CONSTRAINT `fk_medicine_details_medicien_id` FOREIGN KEY (`medicien_id`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD CONSTRAINT `fk_patient_visits_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_patient_visits_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `patient_visit_diseases`
--
ALTER TABLE `patient_visit_diseases`
  ADD CONSTRAINT `fk_patient_visit_diseases_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_patient_visit_diseases_diseases_id` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`),
  ADD CONSTRAINT `fk_patient_visit_diseases_patient_visit_id` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`);

--
-- Constraints for table `patient_visit_medications`
--
ALTER TABLE `patient_visit_medications`
  ADD CONSTRAINT `fk_patient_visit_medications_medicien_detail_id` FOREIGN KEY (`medicien_detail_id`) REFERENCES `medicine_details` (`id`),
  ADD CONSTRAINT `fk_patient_visit_medications_patient_visit_id` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`),
  ADD CONSTRAINT `fk_patient_visit_medicaton_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `patient_visit_tests`
--
ALTER TABLE `patient_visit_tests`
  ADD CONSTRAINT `fk_patient_visit_tests_lab_test_id` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`),
  ADD CONSTRAINT `fk_patient_visit_tests_patient_visit_id` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
