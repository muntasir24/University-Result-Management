-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 07:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resultapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `name`, `password`) VALUES
('admin', 'a', '$2y$12$00okZWVkMzk2OGY1ZmRjO.lzVvNEY7t9FyI9aBq2Qqar8H6cfMnAi');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cgpa`
-- (See below for the actual view)
--
CREATE TABLE `cgpa` (
`reg_no` int(11)
,`dept_name` varchar(255)
,`session` varchar(50)
,`semester` int(2)
,`cgpa` decimal(29,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_name` varchar(255) NOT NULL,
  `chairman_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_name`, `chairman_name`) VALUES
('BANGLA', 'Md. Angur Hossain'),
('CSE', 'Mala Rani Barman');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` char(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `footer` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `admin_login_bg` varchar(255) NOT NULL,
  `teacher_login_bg` varchar(255) NOT NULL,
  `result_bg` varchar(255) NOT NULL,
  `main_url` varchar(255) NOT NULL,
  `VC_name` varchar(255) NOT NULL,
  `student_login_bg` varchar(255) NOT NULL,
  `varsity_name` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `email`, `phone_no`, `address`, `footer`, `logo`, `admin_login_bg`, `teacher_login_bg`, `result_bg`, `main_url`, `VC_name`, `student_login_bg`, `varsity_name`) VALUES
(1, 'info@shu.edu.bd', '88029977350', 'Netrokona', 'Sheikh Hasina University, Netrokona. All rights reserved', 'SHU-logo-HQ.png', 'SHU-logo-HQ.png', '', '', 'http://localhost/resultapp', '', 'SHU-logo-HQ.png', 'Sheikh Hasina University');

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

CREATE TABLE `publish` (
  `is_published` tinyint(1) DEFAULT 0,
  `session` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `reg_no` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `session` varchar(50) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `attendence` int(5) NOT NULL DEFAULT 0,
  `mid` int(5) NOT NULL DEFAULT 0,
  `final` int(5) NOT NULL DEFAULT 0,
  `letter_grade` varchar(10) NOT NULL,
  `grade_point` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`reg_no`, `dept_name`, `session`, `subject_code`, `attendence`, `mid`, `final`, `letter_grade`, `grade_point`) VALUES
(20200410, 'CSE', '2020-2021', 'CSE-2201', 10, 30, 5, 'C', 2.25),
(20200410, 'CSE', '2020-2021', 'CSE-2202', 10, 10, 60, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2203', 10, 30, 50, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2204', 10, 28, 50, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2205', 10, 30, 45, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2211', 10, 30, 60, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2212', 10, 25, 45, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-2216', 10, 30, 40, 'A+', 4.00),
(20200410, 'CSE', '2020-2021', 'CSE-3101', 10, 30, 50, 'A+', 4.00),
(20200414, 'CSE', '2020-2021', 'CSE-2201', 9, 0, 5, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2202', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2203', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2204', 10, 30, 40, 'A+', 4.00),
(20200414, 'CSE', '2020-2021', 'CSE-2205', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2211', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2212', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-2216', 0, 0, 0, 'F', 0.00),
(20200414, 'CSE', '2020-2021', 'CSE-3101', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2201', 7, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2202', 10, 30, 30, 'A-', 3.50),
(20200419, 'CSE', '2020-2021', 'CSE-2203', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2204', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2205', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2211', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2212', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-2216', 0, 0, 0, 'F', 0.00),
(20200419, 'CSE', '2020-2021', 'CSE-3101', 0, 0, 0, 'F', 0.00),
(20240101, 'BANGLA', '2024-2025', 'BAN-3210', 1, 1, 60, 'B', 3.00);

--
-- Triggers `result`
--
DELIMITER $$
CREATE TRIGGER `calculate_grades` BEFORE INSERT ON `result` FOR EACH ROW BEGIN
    DECLARE total_score DECIMAL(5,2);

    -- Calculate total score
    SET total_score = NEW.attendence + NEW.mid + NEW.final;

    -- Determine letter grade and grade point based on the grading scale
    IF total_score >= 80 THEN
        SET NEW.letter_grade = 'A+';
        SET NEW.grade_point = 4.00;
    ELSEIF total_score >= 75 THEN
        SET NEW.letter_grade = 'A';
        SET NEW.grade_point = 3.75;
    ELSEIF total_score >= 70 THEN
        SET NEW.letter_grade = 'A-';
        SET NEW.grade_point = 3.50;
    ELSEIF total_score >= 65 THEN
        SET NEW.letter_grade = 'B+';
        SET NEW.grade_point = 3.25;
    ELSEIF total_score >= 60 THEN
        SET NEW.letter_grade = 'B';
        SET NEW.grade_point = 3.00;
    ELSEIF total_score >= 55 THEN
        SET NEW.letter_grade = 'B-';
        SET NEW.grade_point = 2.75;
    ELSEIF total_score >= 50 THEN
        SET NEW.letter_grade = 'C+';
        SET NEW.grade_point = 2.50;
    ELSEIF total_score >= 45 THEN
        SET NEW.letter_grade = 'C';
        SET NEW.grade_point = 2.25;
    ELSEIF total_score >= 40 THEN
        SET NEW.letter_grade = 'D';
        SET NEW.grade_point = 2.00;
    ELSE
        SET NEW.letter_grade = 'F';
        SET NEW.grade_point = 0.00;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_grades_before_update` BEFORE UPDATE ON `result` FOR EACH ROW BEGIN
    DECLARE total_score DECIMAL(5,2);

    -- Calculate total score for the updated values
    SET total_score = NEW.attendence + NEW.mid + NEW.final;

    -- Determine letter grade and grade point based on the grading scale
    IF total_score >= 80 THEN
        SET NEW.letter_grade = 'A+';
        SET NEW.grade_point = 4.00;
    ELSEIF total_score >= 75 THEN
        SET NEW.letter_grade = 'A';
        SET NEW.grade_point = 3.75;
    ELSEIF total_score >= 70 THEN
        SET NEW.letter_grade = 'A-';
        SET NEW.grade_point = 3.50;
    ELSEIF total_score >= 65 THEN
        SET NEW.letter_grade = 'B+';
        SET NEW.grade_point = 3.25;
    ELSEIF total_score >= 60 THEN
        SET NEW.letter_grade = 'B';
        SET NEW.grade_point = 3.00;
    ELSEIF total_score >= 55 THEN
        SET NEW.letter_grade = 'B-';
        SET NEW.grade_point = 2.75;
    ELSEIF total_score >= 50 THEN
        SET NEW.letter_grade = 'C+';
        SET NEW.grade_point = 2.50;
    ELSEIF total_score >= 45 THEN
        SET NEW.letter_grade = 'C';
        SET NEW.grade_point = 2.25;
    ELSEIF total_score >= 40 THEN
        SET NEW.letter_grade = 'D';
        SET NEW.grade_point = 2.00;
    ELSE
        SET NEW.letter_grade = 'F';
        SET NEW.grade_point = 0.00;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session` varchar(50) NOT NULL CHECK (`session` regexp '^[0-9]{4}-[0-9]{4}$'),
  `dept_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session`, `dept_name`, `capacity`) VALUES
('2019-2020', 'CSE', 0),
('2020-2021', 'BANGLA', 0),
('2020-2021', 'CSE', 0),
('2022-2023', 'BANGLA', 0),
('2022-2023', 'CSE', 0),
('2023-2024', 'BANGLA', 0),
('2023-2024', 'CSE', 0),
('2024-2025', 'BANGLA', 1),
('2024-2025', 'CSE', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `session` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `name`, `password`, `photo`, `dept_name`, `session`) VALUES
(20200410, 'Muhammad Zia', '$2y$12$00okMjc3YWY3NjU0MzY4O.Llz4Q9Jep0XUOjE4fdi/ssyCM2Pmp.i', 'zia.jpg', 'CSE', '2020-2021'),
(20200414, 'Imtius Ahmed', '$2y$12$00okMzg1NDIxNDc5ZWE1Z.OiJ5OaWco/eX07Vl8vZk4c4gRaW25i2', 'imtius.jpg', 'CSE', '2020-2021'),
(20200419, 'Waz Kuruni', '$2y$12$00okNTg0NWJmY2EzMWUwMO1cehFIuRQi5JRqDz2ppxtT/fGKF9YoK', 'waz.jpg', 'CSE', '2020-2021'),
(20240101, 'test', '$2y$12$00okNjRiZWFmMmQ5YmJhMeoJtdcXfHTuU3vGB1Ww1Vo.5kqVmlZda', '', 'BANGLA', '2024-2025');

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `after_student_delete` AFTER DELETE ON `student` FOR EACH ROW UPDATE session s
    SET s.capacity = s.capacity - 1
    WHERE s.dept_name = OLD.dept_name
      AND s.session = OLD.session
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_student_insert_update` AFTER INSERT ON `student` FOR EACH ROW UPDATE session s
    SET s.capacity = s.capacity + 1
    WHERE s.dept_name = NEW.dept_name
      AND s.session = NEW.session
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_reg_no` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
    -- Extract the department number based on dept_name
    DECLARE dept_number INT;
    IF NEW.dept_name = 'CSE' THEN
        SET dept_number = 4;
    ELSEIF NEW.dept_name = 'BANGLA' THEN
        SET dept_number = 1;
        ELSEIF NEW.dept_name='ECONOMICS' THEN
        SET dept_number = 3;
        ELSEIF NEW.dept_name='ENGLISH' THEN
        SET dept_number = 2;
    -- Add more conditions for other departments as needed
    ELSE
        -- Default to a specific department number if not matched
        SET dept_number = 00;
    END IF;

    -- Create the registration number using the current year, dept_number, and user-provided roll number
    SET NEW.reg_no = CONCAT(
        YEAR(CURDATE()), 
        LPAD(dept_number, 2, '0'),
        LPAD(SUBSTRING(NEW.reg_no, 1, 2), 2, '0')
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_student_insert` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
    SET NEW.session = CONCAT(YEAR(CURDATE()), '-', YEAR(CURDATE()) + 1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_code` varchar(50) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `t_name` varchar(50) NOT NULL,
  `credit` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `semester`, `subject_name`, `dept_name`, `t_name`, `credit`) VALUES
('BAN-3210', '3rd Year 2nd Semester', 'BANGLA', 'BANGLA', 'Md. Abdul Halim', 2.00),
('CSE-2201', '2nd Year 2nd Semester', 'Database Management Systems', 'CSE', 'Md. Anwarul Islam', 3.00),
('CSE-2202', '2nd Year 2nd Semester', 'Design and Analysis of Algorithms', 'CSE', 'Sharad Hasan', 3.00),
('CSE-2203', '2nd Year 2nd Semester', 'Data and Telecommunication', 'CSE', 'MS. SHIFAT ARA RAFIQ', 3.00),
('CSE-2204', '2nd Year 2nd Semester', 'Computer Architecture and Organization', 'CSE', 'Abdullah Al Shiam', 3.00),
('CSE-2205', '2nd Year 2nd Semester', 'Introduction to Mechatronics', 'CSE', 'external', 2.00),
('CSE-2211', '2nd Year 2nd Semester', 'Database Management Systems Lab', 'CSE', 'Md. Anwarul Islam', 1.50),
('CSE-2212', '2nd Year 2nd Semester', 'Design and Analysis of Algorithms Lab', 'CSE', 'Sharad Hasan', 1.50),
('CSE-2216', '2nd Year 2nd Semester', 'Application Development Lab', 'CSE', 'Abdullah Al Shiam', 1.50),
('CSE-3101', '3rd Year 1st Semester', 'Computer Networking', 'CSE', 'Abdullah Al Shiam', 3.00);

--
-- Triggers `subjects`
--
DELIMITER $$
CREATE TRIGGER `auto_semester_insert` BEFORE INSERT ON `subjects` FOR EACH ROW BEGIN
    DECLARE year_prefix VARCHAR(1);
    DECLARE semester_prefix VARCHAR(1);

    -- Extract the year and semester prefixes from the subject code
    SET year_prefix = SUBSTRING(NEW.subject_code, 5, 1);
    SET semester_prefix = SUBSTRING(NEW.subject_code, 6, 1);

    -- Determine the year based on the extracted year prefix
    CASE year_prefix
        WHEN '1' THEN SET NEW.semester = '1st Year ';
        WHEN '2' THEN SET NEW.semester = '2nd Year ';
        WHEN '3' THEN SET NEW.semester = '3rd Year ';
        WHEN '4' THEN SET NEW.semester = '4th Year ';
        -- Add more cases if needed for other years
        ELSE SET NEW.semester = NULL; -- Set a default value or handle as needed
    END CASE;

    -- Determine the semester based on the extracted semester prefix
    CASE semester_prefix
        WHEN '1' THEN SET NEW.semester = CONCAT(NEW.semester, '1st Semester');
        WHEN '2' THEN SET NEW.semester = CONCAT(NEW.semester, '2nd Semester');
        WHEN '3' THEN SET NEW.semester = CONCAT(NEW.semester, '3rd Semester');
        WHEN '4' THEN SET NEW.semester = CONCAT(NEW.semester, '4th Semester');
        -- Add more cases if needed for other semesters
        ELSE SET NEW.semester = 'not known'; -- Set a default value or handle as needed
    END CASE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `subjects_view`
-- (See below for the actual view)
--
CREATE TABLE `subjects_view` (
`dept_name` varchar(255)
,`semester` varchar(255)
,`tot_credits` decimal(25,2)
,`tot_subjects` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`name`, `username`, `password`, `dept_name`, `login_time`) VALUES
('Abdullah Al Shiam', 'teacher1', '$2y$12$00okODg2MzYzZGZlNTIyMO6BO2fAQ2hhjQ8.xziTYLCLg1GV5m1xO', 'CSE', '2024-02-06 09:39:19'),
('Dr. Sanjida Islam', 't3', '$2y$12$00okZGUwN2YyMjFmOTZhZ.q2jWfZ./V3pMFSZxNOs1O4urPjA/jRa', 'BANGLA', '2024-02-06 09:39:19'),
('external', 'e', '$2y$12$00okODg2MzYzZGZlNTIyMO6BO2fAQ2hhjQ8.xziTYLCLg1GV5m1xO', 'CSE', '2024-02-06 09:39:19'),
('Mala Rani Barman', 'chairman', '$2y$12$00okZjlmZDJlOTQ5YmIyZ.IapA1eQmv8jksr92bSUt1cDPt81t0IG', 'CSE', '2024-02-06 09:39:19'),
('Md. Abdul Halim', 't2', '$2y$12$00okOGMyOTMwYjJhZTVlMeYzk9r5gSrgF1odwcAengJ7WvuYyo65a', 'BANGLA', '2024-02-06 09:39:19'),
('Md. Angur Hossain', 't1', '$2y$12$00okN2RmMDk0OTYzNTg3ZOty/thunP9b.Y89M8A3D4vqZM08HZ8AC', 'BANGLA', '2024-02-06 09:39:19'),
('Md. Anwarul Islam', 'teacher2', '$2y$12$00okODg2MzYzZGZlNTIyMO6BO2fAQ2hhjQ8.xziTYLCLg1GV5m1xO', 'CSE', '2024-02-06 09:39:19'),
('Md. Najmul Hasan', 't4', '$2y$12$00okNzM3NDA1YTE3NDM2M.wrBu3qYsPdCeuBnT4SHxg1FFvA.JpMK', 'BANGLA', '2024-02-06 09:39:19'),
('MS. SHIFAT ARA RAFIQ', 'teacher4', '$2y$12$00okMDNlZTBkYjk1OTRiNu70xt.ZoOonD5AHLzSCvZ9sDZ8Vo1DbG', 'CSE', '2024-02-06 09:39:19'),
('Sharad Hasan', 'teacher3', '$2y$12$00okOGQyMjI0MWJhZDg3ZeSA4SDViAT7j3vyLUuUQNZbhDutwqZve', 'CSE', '2024-02-06 09:39:19');

-- --------------------------------------------------------

--
-- Structure for view `cgpa`
--
DROP TABLE IF EXISTS `cgpa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cgpa`  AS SELECT `r`.`reg_no` AS `reg_no`, `r`.`dept_name` AS `dept_name`, `r`.`session` AS `session`, cast(substr(substring_index(`r`.`subject_code`,'-',-1),1,2) as signed) AS `semester`, round(sum(`s`.`credit` * `r`.`grade_point`) / sum(`s`.`credit`),2) AS `cgpa` FROM (`result` `r` join `subjects` `s` on(cast(substr(substring_index(`r`.`subject_code`,'-',-1),1,2) as signed) = cast(substr(substring_index(`s`.`subject_code`,'-',-1),1,2) as signed))) GROUP BY `r`.`reg_no`, `r`.`dept_name`, `r`.`session`, `s`.`semester` ;

-- --------------------------------------------------------

--
-- Structure for view `subjects_view`
--
DROP TABLE IF EXISTS `subjects_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subjects_view`  AS SELECT `subjects`.`dept_name` AS `dept_name`, `subjects`.`semester` AS `semester`, sum(`subjects`.`credit`) AS `tot_credits`, count(0) AS `tot_subjects` FROM `subjects` GROUP BY `subjects`.`dept_name`, `subjects`.`semester` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_name`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`session`,`semester`,`dept_name`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`reg_no`,`dept_name`,`session`,`subject_code`),
  ADD KEY `dept_name` (`dept_name`),
  ADD KEY `session` (`session`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session`,`dept_name`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `dept_name` (`dept_name`),
  ADD KEY `session` (`session`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`),
  ADD KEY `dept_name` (`dept_name`),
  ADD KEY `t_name` (`t_name`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`name`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `publish`
--
ALTER TABLE `publish`
  ADD CONSTRAINT `publish_ibfk_1` FOREIGN KEY (`session`) REFERENCES `session` (`session`),
  ADD CONSTRAINT `publish_ibfk_2` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`session`) REFERENCES `session` (`session`),
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`),
  ADD CONSTRAINT `result_ibfk_4` FOREIGN KEY (`reg_no`) REFERENCES `student` (`reg_no`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`session`) REFERENCES `session` (`session`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`),
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`t_name`) REFERENCES `teachers` (`name`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `external_timeout` ON SCHEDULE EVERY 1 SECOND STARTS '2024-02-07 00:47:04' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE teachers
    SET password = 'over'
    WHERE username LIKE 'external%' AND TIMESTAMPDIFF(SECOND, login_time, NOW()) > 12$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
