-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2024 at 08:30 AM
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
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `c_id` smallint(6) NOT NULL,
  `city_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`c_id`, `city_name`) VALUES
(1, 'chennai'),
(2, 'pondy'),
(3, 'mahe'),
(4, 'trichy'),
(5, 'kochi'),
(6, 'bangalore'),
(7, 'hyderabad'),
(8, 'delhi');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` smallint(6) NOT NULL,
  `country_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'india');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `d_id` tinyint(4) NOT NULL,
  `designation_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`d_id`, `designation_name`) VALUES
(1, 'frontend'),
(2, 'backend'),
(3, 'database'),
(4, 'testing'),
(5, 'data analyst'),
(6, 'network engineer'),
(7, 'tech support');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `experience` varchar(20) DEFAULT NULL,
  `r_designation_id` tinyint(4) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `r_city_id` smallint(6) DEFAULT NULL,
  `r_state_id` smallint(6) DEFAULT NULL,
  `r_country_id` smallint(6) DEFAULT NULL,
  `is_deleted` enum('N','Y') DEFAULT 'N',
  `salary` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `dob`, `age`, `doj`, `experience`, `r_designation_id`, `address`, `r_city_id`, `r_state_id`, `r_country_id`, `is_deleted`, `salary`) VALUES
(1, 'ruban', '2002-07-29', 21, '2024-04-08', '0 years 2 months', 2, 'ratna nagar', 7, 2, 1, 'N', 30000.00),
(2, 'edward', '1996-09-16', 27, '2022-08-20', '1 years 9 months', 4, 'ghandhi nagar', 4, 1, 1, 'Y', 25000.00),
(3, 'gokul', '2001-04-19', 23, '2020-02-20', '4 years 3 months', 7, 'lal street', 7, 5, 1, 'N', 32000.00),
(4, 'ram', '2003-05-16', 21, '2022-08-18', '1 years 9 months', 6, 'nehru street', 6, 4, 1, 'N', 32000.00),
(5, 'abinandan', '1997-06-21', 26, '2019-06-15', '4 years 11 months', 5, 'vallalar street', 4, 1, 1, 'N', 55000.00),
(6, 'dass', '1999-03-14', 25, '2024-04-12', '0 years 1 months', 3, 'nungapakkam', 5, 3, 1, 'N', 20000.00),
(7, 'samuel', '2003-01-25', 21, '2023-02-23', '1 years 3 months', 1, 'ruthland street', 3, 2, 1, 'N', 31500.00),
(8, 'jeeva', '1998-03-20', 26, '2021-12-12', '2 years 5 months', 6, 'lal street', 6, 4, 1, 'N', 38000.00),
(9, 'rahul', '2003-05-13', 21, '2024-01-20', '0 years 4 months', 2, 'vallalar street', 6, 4, 1, 'N', 29500.00),
(10, 'hari', '1990-12-11', 33, '2015-05-12', '9 years 0 months', 5, 'modern street', 5, 3, 1, 'N', 71000.00),
(11, 'anish', '1995-02-23', 29, '2019-08-28', '4 years 9 months', 2, 'cheran street', 1, 1, 1, 'N', 48000.00),
(12, 'teja', '2000-12-26', 23, '2022-05-02', '2 years 1 months', 5, 'this street', 7, 5, 1, 'N', 34000.00),
(13, 'abc', '2020-02-20', 4, '2020-02-20', '4 years 3 months', 1, 'street', 7, 4, 1, 'N', 20000.00),
(14, 'xyx', '2020-10-10', 3, '2020-10-10', '3 years 8 months', 2, 'aaaaa', 6, 5, 1, 'N', 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `r_users_id` tinyint(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `r_users_id`, `name`) VALUES
('hr@gmail.com', 'hr@123', 1, 'hr'),
('manager@gmail.com', 'manager@123', 2, 'manager'),
('employee@gmail.com', 'employee', 3, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `m_id` tinyint(4) NOT NULL,
  `m_name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`m_id`, `m_name`) VALUES
(1, 'january'),
(2, 'february'),
(3, 'march'),
(4, 'april'),
(5, 'may'),
(6, 'june'),
(7, 'july'),
(8, 'august'),
(9, 'september'),
(10, 'october'),
(11, 'november'),
(12, 'december');

-- --------------------------------------------------------

--
-- Table structure for table `salary_details`
--

CREATE TABLE `salary_details` (
  `salary_id` int(11) NOT NULL,
  `r_employee_id` int(11) DEFAULT NULL,
  `r_months_id` tinyint(4) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `loss_of_pay` float(10,2) DEFAULT NULL,
  `total_salary` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_details`
--

INSERT INTO `salary_details` (`salary_id`, `r_employee_id`, `r_months_id`, `year`, `loss_of_pay`, `total_salary`) VALUES
(1, 1, 4, 2024, 1200.00, 23800.00),
(2, 1, 5, 2024, 565.00, 24435.00),
(3, 1, 1, 2024, 850.00, 24150.00),
(4, 3, 3, 2022, 1500.00, 30500.00),
(5, 3, 4, 2022, 1200.00, 30800.00),
(6, 3, 5, 2022, 1231.00, 30769.00),
(7, 3, 6, 2022, 1280.00, 30720.00),
(8, 3, 7, 2022, 2300.00, 29700.00),
(9, 3, 8, 2022, 3215.00, 28785.00),
(10, 3, 9, 2022, 570.00, 31430.00),
(11, 3, 10, 2022, 1000.00, 31000.00),
(12, 3, 11, 2022, 2310.00, 29690.00),
(13, 3, 12, 2022, 3500.00, 28500.00),
(14, 2, 1, 2023, 1210.00, 23790.00),
(15, 4, 1, 2023, 1200.00, 30800.00),
(16, 2, 2, 2023, 1200.00, 23800.00),
(17, 1, 1, 2024, 200.00, 24800.00),
(18, 1, 1, 2024, 0.00, 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `s_id` smallint(6) NOT NULL,
  `state_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`s_id`, `state_name`) VALUES
(1, 'tamil nadu'),
(2, 'pondicherry'),
(3, 'kerala'),
(4, 'karnataka'),
(5, 'andra');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` tinyint(4) NOT NULL,
  `uname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `uname`) VALUES
(1, 'Hr'),
(2, 'Manager'),
(3, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `r_designation_id` (`r_designation_id`),
  ADD KEY `r_city_id` (`r_city_id`),
  ADD KEY `r_state_id` (`r_state_id`),
  ADD KEY `r_country_id` (`r_country_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `r_users_id` (`r_users_id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `salary_details`
--
ALTER TABLE `salary_details`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `r_months_id` (`r_months_id`),
  ADD KEY `r_employee_id` (`r_employee_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `c_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `d_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `m_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salary_details`
--
ALTER TABLE `salary_details`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `s_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`r_designation_id`) REFERENCES `designation` (`d_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`r_city_id`) REFERENCES `city` (`c_id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`r_state_id`) REFERENCES `state` (`s_id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`r_country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`r_users_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `salary_details`
--
ALTER TABLE `salary_details`
  ADD CONSTRAINT `salary_details_ibfk_1` FOREIGN KEY (`r_months_id`) REFERENCES `months` (`m_id`),
  ADD CONSTRAINT `salary_details_ibfk_2` FOREIGN KEY (`r_employee_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
