-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2022 at 07:55 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Mark', '0773034311', 'admin@admin.com', '$2y$10$TOg3R1TtbSaBe9IN5oUhCe7qseSqn8AfxUv8OLfKABEc70eDII4tO', 'super', '2022-03-07 11:07:34', '2022-03-07 11:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `cover_letter` varchar(255) NOT NULL,
  `motivation_letter` text NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `candidate_id`, `cv`, `cover_letter`, `motivation_letter`, `status`, `created_at`, `updated_at`) VALUES
(2, 13, 2, 'application to ucu.docx6559', 'application to ucu.docx2868', 'jjj', 'pending', '2022-03-09 11:07:57', '2022-03-09 11:07:57'),
(3, 13, 2, 'application to ucu.docx7158', 'application to ucu.docx3577', 'jjj', 'pending', '2022-03-09 11:09:31', '2022-03-09 11:09:31'),
(4, 13, 2, 'application to ucu.docx8341', 'application to ucu.docx1466', 'hello wol', 'rejected', '2022-03-09 11:11:40', '2022-03-09 11:11:40'),
(5, 13, 2, 'application to ucu.docx6914', 'application to ucu.docx5493', 'hello wol', 'accepted', '2022-03-09 11:19:30', '2022-03-09 11:19:30'),
(6, 14, 2, 'Baraka Mark Bright - IRC.pdf', 'application to ucu.pdf', 'hello', 'accepted', '2022-03-09 11:46:02', '2022-03-09 11:46:02'),
(11, 14, 8, 'ACTIVATION.docx', 'ACTIVATION.docx', 'This is a motivation letter', 'pending', '2022-03-11 15:42:15', '2022-03-11 15:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Hamza', 'Kimuli', '+256704316255', 'kimdigitary@gmail.com', '$2y$10$TOg3R1TtbSaBe9IN5oUhCe7qseSqn8AfxUv8OLfKABEc70eDII4tO', '2022-03-04 06:58:06', '2022-03-04 06:58:06'),
(2, 'Mark Bright', 'Baraka', '0773034311', 'markbrightbaraka@gmail.com', '$2y$10$By2n8eQP2FxbJyrKOd/LzOu.gjEfqE8sJiOMhfnrb2Iyj9R9PwupG', '2022-03-04 07:10:13', '2022-03-04 07:10:13'),
(3, 'aketch', 'carol', '0773034311', 'markbrightbaraka22@gmail.com', '$2y$10$YwPfh5M.xZEelEC/HVjqbeMH7wc9K.w1H3Q.83L8jYm.dtQndRcVS', '2022-03-04 07:11:57', '2022-03-04 07:11:57'),
(8, 'Mark Bright', 'Baraka', '0773034311', 'mark@gmail.com', '$2y$10$bo6VQND1Y1UAo.JPfIrZiumBEkbgTsOMp6nf4IwoxYIXyW99FhqFq', '2022-03-04 08:41:49', '2022-03-04 08:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Information Technology and Computer Science', 'information-technology-and-computer-science', 'active', '2022-03-09 06:32:06', '2022-03-09 06:32:06'),
(6, 'Public Services', 'public-services', 'active', '2022-03-09 06:32:16', '2022-03-09 06:32:16'),
(7, 'Engineering', 'engineering', 'active', '2022-03-09 06:32:24', '2022-03-09 06:32:24'),
(8, 'Charity and Voluntary', 'charity-and-voluntary', 'active', '2022-03-09 06:32:46', '2022-03-09 06:32:46'),
(9, 'Accounting and FInance', 'accounting-and-finance', 'active', '2022-03-09 06:32:58', '2022-03-09 06:32:58'),
(10, 'Human Resource ', 'human-resource-', 'active', '2022-03-09 06:33:28', '2022-03-09 06:33:28'),
(11, 'Medical Services', 'medical-services', 'active', '2022-03-09 06:33:40', '2022-03-09 06:33:40'),
(12, 'Education', 'education', 'active', '2022-03-11 16:57:31', '2022-03-11 16:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `vacancies` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `category_id`, `title`, `slug`, `job_type`, `deadline`, `salary`, `qualification`, `description`, `location`, `vacancies`, `experience`, `created_at`, `updated_at`) VALUES
(4, 9, 'Principal DevOps Engineer (Senior Manager, Technology)', 'principal-devops-engineer-senior-manager-technology-', 'internship', '2022-03-23', '350000', 'bachelors', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Yemeni City', '5', '0', '2022-03-09 06:54:25', '2022-03-09 06:54:25'),
(7, 10, 'Product Designer', 'product-designer', 'contract', '2022-04-08', '4530009', 'diploma', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Dammaj ', '2', '2', '2022-03-09 06:58:38', '2022-03-09 06:58:38'),
(8, 9, 'General Ledger Accountant', 'general-ledger-accountant', 'internship', '2022-04-07', '1200000', 'masters', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Hutayb ', '2', '2', '2022-03-09 06:59:30', '2022-03-09 06:59:30'),
(12, 7, 'Principal DevOps Engineer (Senior Manager, Technology)', 'principal-devops-engineer-senior-manager-technology-', 'internship', '2022-03-23', '980000', 'bachelors', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Yemeni City', '5', '0', '2022-03-09 06:54:25', '2022-03-09 06:54:25'),
(13, 6, 'Product Designer', 'product-designer', 'contract', '2022-04-08', '750000', 'diploma', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Dammaj ', '2', '2', '2022-03-09 06:58:38', '2022-03-09 06:58:38'),
(14, 11, 'Finance Manager and Health', 'finance-manager-and-health', 'contract', '2022-04-07', '2300000', 'bachelors', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim a erat sit vulputate elementum orci. Risus nec viverra ornare venenatis proin ac varius tristique ut. Vitae egestas tellus amet nulla cursus.ands Pellentesque placerat maecenas egestas ', 'Hutayb ', '2', '2', '2022-03-09 06:59:30', '2022-03-09 06:59:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_ibfk_3` (`candidate_id`),
  ADD KEY `applications_ibfk_4` (`job_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `applications_ibfk_4` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
