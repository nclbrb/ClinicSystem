-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 01:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `fullName` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `emergencyContactName` varchar(255) NOT NULL,
  `emergencyContactRelationship` varchar(255) NOT NULL,
  `emergencyContactPhone` varchar(20) NOT NULL,
  `guardianName` varchar(255) NOT NULL,
  `guardianRelationship` varchar(255) NOT NULL,
  `guardianContact` varchar(20) NOT NULL,
  `onsetDuration` text NOT NULL,
  `currentCondition` text NOT NULL,
  `pastMedicalHistory` text NOT NULL,
  `immunizationHistory` text NOT NULL,
  `allergies` text NOT NULL,
  `currentMedications` text NOT NULL,
  `familyMedicalHistory` text NOT NULL,
  `parentalConsent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `fullName`, `dob`, `age`, `gender`, `address`, `contact`, `emergencyContactName`, `emergencyContactRelationship`, `emergencyContactPhone`, `guardianName`, `guardianRelationship`, `guardianContact`, `onsetDuration`, `currentCondition`, `pastMedicalHistory`, `immunizationHistory`, `allergies`, `currentMedications`, `familyMedicalHistory`, `parentalConsent`) VALUES
(1, 'berto', '2020-06-26', 5, 'Male', 'L.A DC', '0987654352', 'lina', 'mother', '0987654352', 'linda', 'mother', '0987654352', 'cough, fever, flu', '2 weeks having a cough', 'covid-19', 'astrazeneca', 'seafoods', 'bioflu', 'none', 1);

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
