-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 03:50 PM
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
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `patient_full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `guardian_full_name` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `contact_numbers` varchar(255) NOT NULL,
  `additional_contact` varchar(255) DEFAULT NULL,
  `onset_duration` text NOT NULL,
  `current_condition` text NOT NULL,
  `past_medical_history` text NOT NULL,
  `allergies` text NOT NULL,
  `current_medications` text NOT NULL,
  `family_medical_history` text NOT NULL,
  `consent` tinyint(1) NOT NULL DEFAULT 0,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `patient_full_name`, `dob`, `age`, `gender`, `guardian_full_name`, `relationship`, `contact_numbers`, `additional_contact`, `onset_duration`, `current_condition`, `past_medical_history`, `allergies`, `current_medications`, `family_medical_history`, `consent`, `submission_date`) VALUES
(1, 'sample', '2025-02-03', 20, 'Male', 'sample', 'sample', '20', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 1, '2025-02-10 12:27:06'),
(2, 'test', '2025-02-01', 18, 'Female', 'test', 'test', '12', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 1, '2025-02-10 12:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `subjective_symptoms` text NOT NULL,
  `objective_findings` text NOT NULL,
  `assessment_goals` text NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment_plans` text NOT NULL,
  `medications` text NOT NULL,
  `therapies` text NOT NULL,
  `follow_up` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_tests`
--

CREATE TABLE `diagnostic_tests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ur_color` varchar(50) NOT NULL,
  `ur_transparency` varchar(50) NOT NULL,
  `ur_hemoglobin` varchar(50) NOT NULL,
  `ur_hematocrit` varchar(50) NOT NULL,
  `ur_wbc` varchar(50) NOT NULL,
  `ur_pus` varchar(50) NOT NULL,
  `ur_rbc` varchar(50) NOT NULL,
  `ur_platelet` varchar(50) NOT NULL,
  `fec_color` varchar(50) NOT NULL,
  `fec_consistency` varchar(50) NOT NULL,
  `fec_mucus` varchar(50) NOT NULL,
  `fec_blood` varchar(50) NOT NULL,
  `fec_parasites` varchar(50) NOT NULL,
  `fec_ova` varchar(50) NOT NULL,
  `xray_region` text NOT NULL,
  `xray_findings` text NOT NULL,
  `xray_impression` text NOT NULL,
  `xray_recommendation` text NOT NULL,
  `blood_hemoglobin` varchar(50) NOT NULL,
  `blood_hematocrit` varchar(50) NOT NULL,
  `blood_wbc` varchar(50) NOT NULL,
  `blood_rbc` varchar(50) NOT NULL,
  `blood_platelet` varchar(50) NOT NULL,
  `blood_other` varchar(50) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_tests`
--

CREATE TABLE `physical_tests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `past_medical_history` text DEFAULT NULL,
  `family_medical_history` text DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `current_medications` text DEFAULT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `bmi` decimal(5,2) NOT NULL,
  `blood_pressure` varchar(20) NOT NULL,
  `heart_rate` int(11) NOT NULL,
  `temperature` decimal(4,1) NOT NULL,
  `general_appearance` text DEFAULT NULL,
  `head_and_neck` text DEFAULT NULL,
  `eyes` text DEFAULT NULL,
  `ears` text DEFAULT NULL,
  `nose_and_throat` text DEFAULT NULL,
  `chest_and_lungs` text DEFAULT NULL,
  `heart` text DEFAULT NULL,
  `abdomen` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `physical_tests`
--

INSERT INTO `physical_tests` (`id`, `full_name`, `dob`, `age`, `gender`, `past_medical_history`, `family_medical_history`, `allergies`, `current_medications`, `height`, `weight`, `bmi`, `blood_pressure`, `heart_rate`, `temperature`, `general_appearance`, `head_and_neck`, `eyes`, `ears`, `nose_and_throat`, `chest_and_lungs`, `heart`, `abdomen`, `submitted_at`) VALUES
(1, 'sample', '2025-02-02', 20, 'Male', 'sample', 'sample', 'sample', 'sample', 20.00, 20.00, 20.00, '20', 20, 20.0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2025-02-10 12:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', 'password1'),
(2, 'user2', 'password2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostic_tests`
--
ALTER TABLE `diagnostic_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_tests`
--
ALTER TABLE `physical_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diagnostic_tests`
--
ALTER TABLE `diagnostic_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `physical_tests`
--
ALTER TABLE `physical_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
