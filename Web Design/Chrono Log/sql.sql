-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2018 at 05:51 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_employees`
--

CREATE TABLE `assignment_employees` (
  `id` int(11) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_managers`
--

CREATE TABLE `assignment_managers` (
  `id` int(11) NOT NULL,
  `manager_id` varchar(256) NOT NULL,
  `emp_id` varchar(256) NOT NULL,
  `project_id` varchar(256) NOT NULL,
  `emp_uid` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `project_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment_managers`
--

INSERT INTO `assignment_managers` (`id`, `manager_id`, `emp_id`, `project_id`, `emp_uid`, `emp_email`, `project_name`) VALUES
(158, '7', '24', '', '', 'john@nothsor.com', ''),
(159, '7', '23', '', '', 'doron@nothsor.com', ''),
(160, '7', '27', '', '', 'fr@nothsor.com', ''),
(161, '7', '', '69', '', '', 'Project Freedom');

-- --------------------------------------------------------

--
-- Table structure for table `company_info_and_settings`
--

CREATE TABLE `company_info_and_settings` (
  `id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `allow_employee_time_edit` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_info_and_settings`
--

INSERT INTO `company_info_and_settings` (`id`, `org_name`, `org_id`, `allow_employee_time_edit`) VALUES
(1, 'Nothsor', 17, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `emp_uid` varchar(256) NOT NULL,
  `emp_pwd` varchar(256) NOT NULL,
  `emp_org` int(11) NOT NULL,
  `emp_org_name` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_first`, `emp_last`, `emp_email`, `emp_uid`, `emp_pwd`, `emp_org`, `emp_org_name`, `time`) VALUES
(11, 'Aubrey', 'Yates', '1@hotmail.com', 'emp', '$2y$10$6YNRqbvxu4uhl6P3Cb3DH.rARPpjdC.U.34yy8U/.H/npkH2E8F8q', 15, 'Crazy', ''),
(12, 'Boy', 'Toy', 'toy@hotmail.com', 'emp2', '$2y$10$1iGOBzOyLPX.sbFdApD1IerVUmkbhE3vHvc4wMP41kJFlWMenAeO6', 15, 'Crazy', ''),
(13, 'Bob', 'Builder', 'bob@hotmail.com', 'bobnothsor', '$2y$10$cgnLjVuhtVS/Msk0//ufEObfPB/PVCEdK5Qbm9kFc7TucR.Cq2Opu', 17, 'Nothsor', 'gohomeyouloserphp'),
(17, 'Austin', 'Yates', 'austin@hotmail.com', 'austin', '$2y$10$dFgeWHBRrv.V1ZTYcoWVr.uEN3Osmw1DuOgqU..k1nfuvKNXIE9N6', 19, 'Aubrey Company', ''),
(22, 'Aubrey', 'Yates', 'aubrey555@hotmail.com', 'aubreybarbie', '$2y$10$7yggC2KYOt7tA6jSDyF4G.AmywnpQZTPXEPWRTOeUrHXqOT.aD9r2', 20, 'Barbie Doll', ''),
(23, 'Doron', 'Tsachor', 'doron@nothsor.com', 'doron@nothsor.com', '$2y$10$ZBaGDUnFgtl90mv9POE11.hE83a.WW/RYqJ7e94wU2KteQ.tMi2Oy', 17, 'Nothsor', ''),
(24, 'John', 'Kuster', 'john@nothsor.com', 'john@nothsor.com', '$2y$10$w.JI/8.YeTqTsl7dvi9eLegG758Fyc9p/H1R43DoD7.bTkSutL9LC', 17, 'Nothsor', ''),
(25, 'Bob', 'Hills', 'bobhill@hotmail.com', 'bobhill', '$2y$10$d68uLpFmxN8xmKJQr1Az..vV9JDmmSVSJ53f2DYeO7LxnqJLp9s6.', 21, 'Aubrey Company 2', ''),
(26, 'Hosa', 'Yat', 'hy@hotmail.com', 'hy', '$2y$10$.OxXF/7yKqaT6.B9ibN0r.uJkTWidUOvrP0h./zq4Sfs86rn80fUK', 21, 'Aubrey Company 2', ''),
(27, 'Fuhundalishivion', 'Runhallyiabolistiva', 'fr@nothsor.com', 'fr', '$2y$10$ZnBMIsVNKFfpMCSwLV7zzeLo/TviL3OECjJMngo.2raf.v/APOaci', 17, 'Nothsor', ''),
(28, 'S', 'W', 'sw@hotmail.com', 'sw', '$2y$10$rdfx6tHEr8a9bG9LEk88LeVJ9W6ytqDeaFQreIJBQi/072/uJaqD2', 17, 'Nothsor', ''),
(32, 'test', 'test', 'tes@hotmail.com', 'tes', '$2y$10$vt7eADlapCkFUpnxBz/v..Cma6/2cpM7wuFj4QpKSE0N67xHWCoXu', 17, 'Nothsor', ''),
(33, 'new', 'test', 'tester@hotmail.com', 'tester', '$2y$10$ZP7SpSq7lFNE.lbMWCAOrOtMlE0PgNuXNF7wHYXS/oSMx80sQzP16', 17, 'Nothsor', ''),
(34, 'I', 'sa', 'sa@hotmail.com', 'ty', '$2y$10$7cAnIWIW6X.2FXxyBvUI8u/R.31174ldjR4zXMNXaCeKw0PdRe9fO', 17, 'Nothsor', ''),
(35, 'jake', 'nil', 'jake@nothsor.com', 'jaken', '$2y$10$iCMIFXMVxdQvyHD0Ca0H5eTSTf8B5vCZXuwzRfOeHRvoWB/oFdIge', 17, 'Nothsor', ''),
(36, 'Dan', 'Dooble', 'dd@nothsor.com', 'dd', '$2y$10$0wQZH5a/t.m4wjsdL5aGm.LKARDiGcJukYczxL3ops/wxpmMvnmj2', 17, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `emp_id` int(11) NOT NULL,
  `location` varchar(256) NOT NULL,
  `project` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `dow` text NOT NULL,
  `org_id` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `end_event`, `emp_id`, `location`, `project`, `description`, `dow`, `org_id`, `project_id`) VALUES
(314, 'None', '2018-05-01 00:00:00', '2018-05-02 00:00:00', 13, 'None', '', 'None', '', '17', 69),
(315, 'None', '2018-05-02 00:00:00', '2018-05-03 00:00:00', 13, 'None', '', 'None', '', '17', 70),
(316, 'None', '2018-05-08 00:00:00', '2018-05-09 00:00:00', 24, 'None', '', 'None', '', '17', 69),
(317, 'None', '2018-05-02 00:00:00', '2018-05-03 00:00:00', 24, 'None', '', 'None', '', '17', 69),
(318, 'None', '2018-05-03 00:00:00', '2018-05-04 00:00:00', 24, 'None', '', 'None', '', '17', 69);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `manager_first` varchar(256) NOT NULL,
  `manager_last` varchar(256) NOT NULL,
  `manager_email` varchar(256) NOT NULL,
  `manager_uid` varchar(256) NOT NULL,
  `manager_pwd` varchar(256) NOT NULL,
  `manager_org_id` int(11) NOT NULL,
  `manager_org_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `manager_first`, `manager_last`, `manager_email`, `manager_uid`, `manager_pwd`, `manager_org_id`, `manager_org_name`) VALUES
(6, 'Austin', 'Yates', 'austin555@hotmail.com', 'austinbarbie', '$2y$10$mckcwlK6AEzkxJGhYjxuKOajXEGOkm9JJ6Lf9prlOAcOEtEm3P0oy', 20, 'Barbie Doll'),
(7, 'Aubrey', 'Yates', 'aubrey@nothsor.com', 'aubrey@nothsor.com', '$2y$10$r/ZG1tDttbPP7hBXzs1l8eEFif94wOpTqlIcxi.xnTaWw.SwymSci', 17, 'Nothsor'),
(8, 'John', 'Fast', 'jf@hotmail.com', 'jf', '$2y$10$4QdajPgBdF8xWmoZXRi6qudJN6cjO4Xf6Nde1SFFmakpuxZPQ0Y8S', 21, 'Aubrey Company 2'),
(9, 'Tim', 'Tooltime', 'timtool@nothsor.com', 'timnothsor', '$2y$10$ueCJgfzHcQdCxLy0IMUXHO7y2YDv0IilQR7OZzvloj7eooSP0y862', 17, 'Nothsor');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `read_status` varchar(256) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `old_date` varchar(256) NOT NULL,
  `new_date` varchar(256) NOT NULL,
  `message` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `read_status`, `emp_id`, `emp_email`, `old_date`, `new_date`, `message`, `org_id`) VALUES
(17, '', 'Yes', 13, 'bob@hotmail.com', '', '', '            mom', 17),
(18, '', 'Yes', 13, 'bob@hotmail.com', '', '', '            Assfd', 17),
(19, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'Listen here buddy. I want a banana.', 17),
(20, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'Good time.s', 17),
(21, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'Here is a message', 17),
(22, '', 'No', 13, 'bob@hotmail.com', '', '', '            asdf', 17),
(23, '', 'Yes', 13, 'bob@hotmail.com', '', '', '            asdfss', 17),
(24, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'sdas', 17),
(25, '', 'No', 13, 'bob@hotmail.com', '', '', 'sdfa', 17);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `hours` decimal(11,6) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `org_id` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `hours`, `project_name`, `uid`, `date`, `org_id`, `description`, `status`) VALUES
(60, '0.000000', 'Test 1', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(61, '0.000000', 'mister box', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(62, '0.000000', 'Going to delete', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(63, '0.000000', 'Check', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(64, '0.000000', 'jkf', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(65, '0.000000', 'bob', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(66, '0.000000', 'set', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(67, '0.000000', 'bob', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(68, '0.000000', 'Save some money', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(69, '0.000000', 'Project Freedom', 0, '2018-05-11 00:00:00', 17, 'This is a project. Do not delete it.', 'active'),
(70, '0.000000', 'Testing', 0, '0000-00-00 00:00:00', 17, '', 'deleted'),
(71, '0.000000', 'Tested project.', 0, '0000-00-00 00:00:00', 17, '', 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `hours` decimal(11,6) NOT NULL,
  `des` varchar(256) NOT NULL,
  `date` varchar(256) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `p_id`, `emp_last`, `emp_first`, `hours`, `des`, `date`, `emp_id`) VALUES
(231, 18, 'Builder', 'Bob', '1.200000', '0.2', '2018-03-21', 13),
(244, 18, 'Builder', 'Bob', '4.000000', '', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `timeGeneral`
--

CREATE TABLE `timeGeneral` (
  `time_id` int(11) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_org_name` varchar(256) NOT NULL,
  `seconds` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `time_start` varchar(256) NOT NULL,
  `time_end` varchar(256) NOT NULL,
  `time_stamp` int(11) NOT NULL,
  `date` varchar(256) NOT NULL,
  `hoursTotal` decimal(11,5) NOT NULL,
  `submitted` varchar(256) NOT NULL,
  `breakstart` int(11) NOT NULL,
  `breakend` int(11) NOT NULL,
  `break_id` int(11) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `time` varchar(256) NOT NULL,
  `des` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeGeneral`
--

INSERT INTO `timeGeneral` (`time_id`, `emp_first`, `emp_last`, `emp_email`, `emp_id`, `emp_org_name`, `seconds`, `minutes`, `hours`, `time_start`, `time_end`, `time_stamp`, `date`, `hoursTotal`, `submitted`, `breakstart`, `breakend`, `break_id`, `project_name`, `project_id`, `time`, `des`) VALUES
(1493, 'John', 'Kuster', 'john@nothsor.com', 24, 'Nothsor', 0, 0, 0, '1525420800', '1525435200', 0, '2018-05-04', '0.00000', 'yes', 0, 0, 0, '', 65, '04:00:00', ''),
(1494, 'John', 'Kuster', 'john@nothsor.com', 24, 'Nothsor', 0, 0, 0, '1525420800', '1525435200', 0, '2018-05-04', '0.00000', 'yes', 0, 0, 0, '', 68, '04:00:00', ''),
(1496, 'Dan', 'Dooble', 'dd@nothsor.com', 36, '', 0, 0, 0, '1525422000', '1525435200', 0, '2018-05-04', '0.00000', 'yes', 0, 0, 0, '', 69, '03:40:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_date` varchar(256) NOT NULL,
  `user_hours` int(11) NOT NULL,
  `org_name` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_date`, `user_hours`, `org_name`, `org_id`) VALUES
(17, 'Abram', 'Nothnagle', 'abram@hotmail.com', 'abram', '$2y$10$yJ/OEztI7xHMDb0aQCputuRQYR4qn9LCaQ2XnBNUeqe9yEuqHYMui', '', 0, 'Nothsor', 17),
(18, 'Aubrey', 'Yates', 'aub@hotmail.com', 'aubrey', '$2y$10$BHy3mCllsrqo/XSAicC8IO/ghcy7MWUXQuukwU2T9PDZNYHdvcCwC', '', 0, 'Nothsor', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_employees`
--
ALTER TABLE `assignment_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_managers`
--
ALTER TABLE `assignment_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_info_and_settings`
--
ALTER TABLE `company_info_and_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `timeGeneral`
--
ALTER TABLE `timeGeneral`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_employees`
--
ALTER TABLE `assignment_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `assignment_managers`
--
ALTER TABLE `assignment_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `timeGeneral`
--
ALTER TABLE `timeGeneral`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1497;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;