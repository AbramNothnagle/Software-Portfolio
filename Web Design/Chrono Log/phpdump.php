-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2018 at 02:56 AM
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

--
-- Dumping data for table `assignment_employees`
--

INSERT INTO `assignment_employees` (`id`, `emp_first`, `emp_last`, `emp_email`, `project_name`, `project_id`, `emp_id`) VALUES
(11, '', '', '', 'Project Freedom 1', 69, 13),
(12, '', '', '', 'Testing Project 1', 70, 13);

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
(178, '7', '', '69', '', '', ''),
(179, '7', '', '70', '', '', ''),
(180, '7', '', '72', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_events`
--

CREATE TABLE `company_events` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `start_event` varchar(256) NOT NULL,
  `end_event` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_info_and_settings`
--

CREATE TABLE `company_info_and_settings` (
  `id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_id` int(11) NOT NULL,
  `allow_employee_time_edit` varchar(256) NOT NULL,
  `allow_manager_time_edit` varchar(256) NOT NULL,
  `org_website` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_info_and_settings`
--

INSERT INTO `company_info_and_settings` (`id`, `org_name`, `org_id`, `allow_employee_time_edit`, `allow_manager_time_edit`, `org_website`) VALUES
(1, 'Nothsor', 17, 'no', 'no', 'www.testsite.com'),
(3, 'foo producers', 30, 'no', 'yes', ''),
(4, 'ak', 31, 'no', 'yes', ''),
(5, 'gods of above', 32, 'no', 'yes', '');

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
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_first`, `emp_last`, `emp_email`, `emp_uid`, `emp_pwd`, `emp_org`, `emp_org_name`, `status`) VALUES
(11, 'Aubrey', 'Yates', '1@hotmail.com', 'emp', '$2y$10$6YNRqbvxu4uhl6P3Cb3DH.rARPpjdC.U.34yy8U/.H/npkH2E8F8q', 15, 'Crazy', ''),
(12, 'Boy', 'Toy', 'toy@hotmail.com', 'emp2', '$2y$10$1iGOBzOyLPX.sbFdApD1IerVUmkbhE3vHvc4wMP41kJFlWMenAeO6', 15, 'Crazy', ''),
(13, 'Bob', 'Builder', 'bob@hotmail.com', 'bobnothsor', '$2y$10$cgnLjVuhtVS/Msk0//ufEObfPB/PVCEdK5Qbm9kFc7TucR.Cq2Opu', 17, 'Nothsor', 'active'),
(17, 'Austin', 'Yates', 'austin@hotmail.com', 'austin', '$2y$10$dFgeWHBRrv.V1ZTYcoWVr.uEN3Osmw1DuOgqU..k1nfuvKNXIE9N6', 19, 'Aubrey Company', ''),
(22, 'Aubrey', 'Yates', 'aubrey555@hotmail.com', 'aubreybarbie', '$2y$10$7yggC2KYOt7tA6jSDyF4G.AmywnpQZTPXEPWRTOeUrHXqOT.aD9r2', 20, 'Barbie Doll', ''),
(23, 'Doron', 'Tsachor', 'doron@nothsor.com', 'doron@nothsor.com', '$2y$10$ZBaGDUnFgtl90mv9POE11.hE83a.WW/RYqJ7e94wU2KteQ.tMi2Oy', 17, 'Nothsor', 'active'),
(24, 'John', 'Kuster', 'john@nothsor.com', 'john@nothsor.com', '$2y$10$w.JI/8.YeTqTsl7dvi9eLegG758Fyc9p/H1R43DoD7.bTkSutL9LC', 17, 'Nothsor', 'active'),
(25, 'Bob', 'Hills', 'bobhill@hotmail.com', 'bobhill', '$2y$10$d68uLpFmxN8xmKJQr1Az..vV9JDmmSVSJ53f2DYeO7LxnqJLp9s6.', 21, 'Aubrey Company 2', ''),
(26, 'Hosa', 'Yat', 'hy@hotmail.com', 'hy', '$2y$10$.OxXF/7yKqaT6.B9ibN0r.uJkTWidUOvrP0h./zq4Sfs86rn80fUK', 21, 'Aubrey Company 2', ''),
(27, 'Fuhundalishivion', 'Runhallyiabolistiva', 'fr@nothsor.com', 'fr', '$2y$10$ZnBMIsVNKFfpMCSwLV7zzeLo/TviL3OECjJMngo.2raf.v/APOaci', 17, 'Nothsor', ''),
(28, 'S', 'W', 'sw@hotmail.com', 'sw', '$2y$10$rdfx6tHEr8a9bG9LEk88LeVJ9W6ytqDeaFQreIJBQi/072/uJaqD2', 17, 'Nothsor', ''),
(32, 'test', 'test', 'tes@hotmail.com', 'tes', '$2y$10$vt7eADlapCkFUpnxBz/v..Cma6/2cpM7wuFj4QpKSE0N67xHWCoXu', 17, 'Nothsor', ''),
(33, 'new', 'test', 'tester@hotmail.com', 'tester', '$2y$10$ZP7SpSq7lFNE.lbMWCAOrOtMlE0PgNuXNF7wHYXS/oSMx80sQzP16', 17, 'Nothsor', ''),
(34, 'I', 'sa', 'sa@hotmail.com', 'ty', '$2y$10$7cAnIWIW6X.2FXxyBvUI8u/R.31174ldjR4zXMNXaCeKw0PdRe9fO', 17, 'Nothsor', ''),
(35, 'jake', 'nil', 'jake@nothsor.com', 'jaken', '$2y$10$iCMIFXMVxdQvyHD0Ca0H5eTSTf8B5vCZXuwzRfOeHRvoWB/oFdIge', 17, 'Nothsor', ''),
(36, 'Dan', 'Dooble', 'dd@nothsor.com', 'dd', '$2y$10$0wQZH5a/t.m4wjsdL5aGm.LKARDiGcJukYczxL3ops/wxpmMvnmj2', 17, '', ''),
(37, 'Bob', 'Nees', 'assd@hotmail.com', 'boo', '$2y$10$EQMwKt1zPp6d8Y6HJP9GT.m6ubRxH0aSTEfEnz5nuO1B6dXGOPIJ.', 17, '', ''),
(38, 'Bob', 'Yates', 'by@ht.com', 'bye', '$2y$10$rRnx.vcEeYEC32NpRyOc5eI3qU/yXE0AUU2SqkJnQFnzH.9cMMggG', 17, '', ''),
(39, 'Good', 'Ti', 'git@hotmail.com', 'big', '$2y$10$jbKpQ/D0V1TvK0BmqZUM0.T1Klp4MOD/FD4V2mOz9LzMC9XFgPk0K', 17, '', ''),
(40, 'You', 'Tube', 'ay@youtube.com', 'mootube', '$2y$10$4S1js1sRqJ7DZ3k7Of22p.Px4rDeztTUCDnEtQjJDHDd6RyBXrDG.', 17, '', ''),
(41, 'Jim', 'Goody', 'jd@nothsor.com', 'jd', '$2y$10$poedIFEC95.O/Wz7ch5S0.FwLu0q3KQDBITBzilchml0Xo8o4w4eq', 17, '', 'deleted'),
(42, 'joe', 'goober', 'jb@hotmail.com', 'joe', '$2y$10$Zx0TvXOBeDNjxpRW3nzfc.BzdJZmFZEIcrKjLWLKiLTVp.QCH0pDy', 21, '', 'active'),
(43, 'Jesus', 'Christ', 'jesus@jc.com', 'jesus_is_evil', '$2y$10$HQOigWN8/5rUJXs9SAgoyO5R6BNvtz/6QjKh9jKMNHJmHlddV7ffa', 32, '', 'active'),
(44, 'Josh', 'Yum', 'joshyum@nothsor.com', 'joshyum', '$2y$10$lAc/HD3WEqyu820rGDrche64CNKDzJw1iFxzzSZd42h4xBuaQxVtq', 17, '', 'active');

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
  `project_id` int(11) NOT NULL,
  `color` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `end_event`, `emp_id`, `location`, `project`, `description`, `dow`, `org_id`, `project_id`, `color`) VALUES
(314, 'None', '2018-05-01 00:00:00', '2018-05-02 00:00:00', 13, 'None', '', 'None', '', '17', 69, ''),
(315, 'None', '2018-05-03 00:00:00', '2018-05-04 00:00:00', 13, 'None', '', 'None', '', '17', 70, ''),
(316, 'None', '2018-05-09 00:00:00', '2018-05-10 00:00:00', 24, 'None', '', 'None', '', '17', 69, ''),
(317, 'None', '2018-05-08 00:00:00', '2018-05-09 00:00:00', 24, 'None', '', 'None', '', '17', 69, ''),
(318, 'None', '2018-05-03 00:00:00', '2018-05-04 00:00:00', 24, 'None', '', 'None', '', '17', 69, ''),
(319, 'None', '2018-04-29 00:00:00', '2018-04-30 00:00:00', 13, '', '', '', '', '17', 69, ''),
(320, 'None', '2018-05-07 00:00:00', '2018-05-08 00:00:00', 23, '', '', '', '', '17', 69, ''),
(323, 'None', '2018-04-30 00:00:00', '2018-05-01 00:00:00', 28, '', '', '', '', '17', 69, ''),
(324, 'None', '2018-05-08 00:00:00', '2018-05-09 00:00:00', 13, 'None', '', 'None', '', '17', 71, ''),
(325, 'None', '2018-05-08 00:00:00', '2018-05-09 00:00:00', 13, 'None', '', 'None', '', '17', 71, ''),
(326, 'None', '2018-05-09 00:00:00', '2018-05-10 00:00:00', 13, 'None', '', 'None', '', '17', 71, ''),
(327, 'None', '2018-05-10 00:00:00', '2018-05-11 00:00:00', 23, '', '', '', '', '17', 69, ''),
(328, 'None', '2018-05-11 00:00:00', '2018-05-12 00:00:00', 23, '', '', '', '', '17', 69, ''),
(329, 'None', '2018-05-16 00:00:00', '2018-05-20 00:00:00', 23, '', '', '', '', '17', 69, ''),
(344, 'None', '2018-05-30 06:30:00', '2018-05-30 10:30:00', 23, '', '', '', '', '17', 69, ''),
(345, 'God', '2018-05-27 08:30:00', '2018-05-27 13:00:00', 13, '', '', '', '', '17', 69, ''),
(346, 'God', '2018-05-28 08:30:00', '2018-05-28 13:00:00', 23, '', '', '', '', '17', 69, ''),
(347, 'God', '2018-06-01 06:00:00', '2018-06-01 10:30:00', 24, '', '', '', '', '17', 71, ''),
(353, 'God', '2018-06-06 14:00:00', '2018-06-06 18:30:00', 35, '', '', '', '', '17', 69, ''),
(354, 'God', '2018-06-02 11:00:00', '2018-06-02 15:30:00', 36, '', '', '', '', '17', 69, ''),
(355, 'God', '2018-06-01 11:00:00', '2018-06-01 15:30:00', 37, '', '', '', '', '17', 69, ''),
(356, 'God', '2018-05-31 11:00:00', '2018-05-31 15:30:00', 38, '', '', '', '', '17', 70, ''),
(357, 'God', '2018-05-29 14:00:00', '2018-05-29 18:30:00', 39, '', '', '', '', '17', 69, ''),
(358, 'God', '2018-05-29 08:30:00', '2018-05-29 13:00:00', 40, '', '', '', '', '17', 69, ''),
(359, 'God', '2018-05-30 14:00:00', '2018-05-30 16:00:00', 23, '', '', '', '', '17', 69, ''),
(360, 'God', '2018-05-31 17:30:00', '2018-05-31 20:00:00', 24, '', '', '', '', '17', 71, ''),
(361, 'bob', '2018-06-12 00:00:00', '2018-06-13 00:00:00', 13, '', '', '', '', '17', 69, ''),
(362, 'bob', '2018-06-04 00:00:00', '2018-06-05 00:00:00', 23, '', '', '', '', '17', 69, ''),
(363, 'bob', '2018-06-08 00:00:00', '2018-06-09 00:00:00', 24, '', '', '', '', '17', 69, ''),
(364, 'bob', '2018-06-04 00:00:00', '2018-06-05 00:00:00', 27, '', '', '', '', '17', 69, ''),
(365, 'bob', '2018-06-06 00:00:00', '2018-06-07 00:00:00', 28, '', '', '', '', '17', 69, ''),
(366, 'bob', '2018-06-13 00:00:00', '2018-06-14 00:00:00', 32, '', '', '', '', '17', 69, ''),
(367, 'bob', '2018-06-08 00:00:00', '2018-06-09 00:00:00', 33, '', '', '', '', '17', 69, ''),
(368, 'bob', '2018-06-19 00:00:00', '2018-06-20 00:00:00', 34, '', '', '', '', '17', 69, ''),
(369, 'bob', '2018-06-07 00:00:00', '2018-06-08 00:00:00', 35, '', '', '', '', '17', 69, ''),
(370, 'bob', '2018-06-14 00:00:00', '2018-06-15 00:00:00', 36, '', '', '', '', '17', 69, ''),
(371, 'bob', '2018-06-08 00:00:00', '2018-06-09 00:00:00', 37, '', '', '', '', '17', 69, ''),
(372, 'bob', '2018-06-08 00:00:00', '2018-06-09 00:00:00', 38, '', '', '', '', '17', 69, ''),
(373, 'bob', '2018-06-07 00:00:00', '2018-06-08 00:00:00', 39, '', '', '', '', '17', 69, ''),
(374, 'bob', '2018-06-05 00:00:00', '2018-06-06 00:00:00', 40, '', '', '', '', '17', 69, ''),
(375, 'bob', '2018-06-14 00:00:00', '2018-06-15 00:00:00', 41, '', '', '', '', '17', 69, ''),
(376, 'bob', '2018-06-04 00:00:00', '2018-06-05 00:00:00', 44, '', '', '', '', '17', 69, ''),
(377, 'God', '2018-06-05 00:00:00', '2018-06-13 00:00:00', 24, '', '', '', '', '17', 71, ''),
(379, 'God', '2018-05-28 00:00:00', '2018-06-21 00:00:00', 24, '', '', '', '', '17', 71, ''),
(380, 'God', '2018-06-26 06:00:00', '2018-06-26 11:30:00', 24, '', '', '', '', '17', 71, ''),
(381, 'God', '2018-06-28 09:00:00', '2018-06-28 11:45:00', 24, '', '', '', '', '17', 71, '');

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
  `manager_org_name` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `manager_first`, `manager_last`, `manager_email`, `manager_uid`, `manager_pwd`, `manager_org_id`, `manager_org_name`, `status`) VALUES
(6, 'Austin', 'Yates', 'austin555@hotmail.com', 'austinbarbie', '$2y$10$mckcwlK6AEzkxJGhYjxuKOajXEGOkm9JJ6Lf9prlOAcOEtEm3P0oy', 20, 'Barbie Doll', ''),
(7, 'Aubrey', 'Yates', 'aubrey@nothsor.com', 'aubrey@nothsor.com', '$2y$10$r/ZG1tDttbPP7hBXzs1l8eEFif94wOpTqlIcxi.xnTaWw.SwymSci', 17, 'Nothsor', 'active'),
(8, 'John', 'Fast', 'jf@hotmail.com', 'jf', '$2y$10$4QdajPgBdF8xWmoZXRi6qudJN6cjO4Xf6Nde1SFFmakpuxZPQ0Y8S', 21, 'Aubrey Company 2', ''),
(9, 'Tim', 'Tooltime', 'timtool@nothsor.com', 'timnothsor', '$2y$10$ueCJgfzHcQdCxLy0IMUXHO7y2YDv0IilQR7OZzvloj7eooSP0y862', 17, 'Nothsor', 'deleted'),
(10, 'Bh', 'Lsr', 'nh@hy.com', 'byi', '$2y$10$c0janU3bbmv6g8nryATIiOkoHowxqUpebeT5VBSwziBnIShxDDOE.', 0, '17', ''),
(11, 'gog', 'do', 'ga@hotmail.com', 'god2', '$2y$10$3xH1IXdBiKLMmk8p/jvJWOyvziLc.H3h4KQ187DSsJNfFLOcuxcnW', 0, '17', ''),
(12, 'mo', 'st', 'tes2@hotm.com', 'aas', '$2y$10$QszhqCNUHJcawInXMne7MOaig.1RqPeDlBqGqtUq1qDU9/Doo9KlG', 0, '17', ''),
(13, 'bo', 'tes', 'klsd@hot.com', 'tesa', '$2y$10$KJBZnqaVIdEL44SOg/cQdep3ELHfUop/OgNo2BLaZ4cd/qg7n/tqe', 0, '17', ''),
(14, 'yogi', 'togi', 'ty@yogi.com', 'gottobeyogi', '$2y$10$9gOuUGgKb09I9VHMHMPSk.iMqjrQARjEjANvOSR48ExYfGv65xHgW', 0, '17', 'active'),
(15, 'fsd', 'sadf', 'adsfa@hotmail.com', 'sdfa', '$2y$10$Ytt8NC0.gxGX6brDP5M0jeTV/bm6Sfofs4p.CQs9EOhXBHVUDazJS', 17, '', 'deleted');

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
(22, '', 'Yes', 13, 'bob@hotmail.com', '', '', '            asdf', 17),
(23, '', 'Yes', 13, 'bob@hotmail.com', '', '', '            asdfss', 17),
(24, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'sdas', 17),
(25, '', 'Yes', 13, 'bob@hotmail.com', '', '', 'sdfa', 17);

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
  `status` varchar(256) NOT NULL,
  `job_code` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `hours`, `project_name`, `uid`, `date`, `org_id`, `description`, `status`, `job_code`) VALUES
(69, '0.000000', 'Project Freedom 1', 0, '2018-05-18 00:00:00', 17, 'This is a project in testing.', 'active', 'JOB_TEST'),
(70, '0.000000', 'Testing Project 1', 0, '2018-05-19 00:00:00', 17, '', 'active', ''),
(71, '0.000000', 'Job test project', 0, '2018-05-19 00:00:00', 17, 'Testing for editing.', 'active', 'job999'),
(72, '0.000000', 'Secret World Domination', 0, '2045-06-07 00:00:00', 17, 'We will rule the entire world by this date!', 'active', 'this is a highly secret code'),
(73, '0.000000', 'Destroy the people on earth', 0, '0000-00-00 00:00:00', 32, '', 'active', 'destroy all'),
(74, '0.000000', 'Create Database', 17, '2018-06-20 00:00:00', 17, 'This is where we cooked up hands.', 'active', 'hands01');

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
  `emp_id` int(11) NOT NULL,
  `emp_org_id` int(11) NOT NULL,
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
  `des` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeGeneral`
--

INSERT INTO `timeGeneral` (`time_id`, `emp_id`, `emp_org_id`, `time_start`, `time_end`, `time_stamp`, `date`, `hoursTotal`, `submitted`, `breakstart`, `breakend`, `break_id`, `project_name`, `project_id`, `time`, `des`, `status`) VALUES
(1822, 13, 17, '1527841260', '1527842700', 0, '2018-06-01', '0.00000', 'yes', 0, 0, 0, '', 71, '00:24:00', '', 'active'),
(1823, 13, 17, '1528618871', '1528618875', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '00:00:03', '', 'deleted'),
(1824, 13, 17, '1528618902', '1528618917', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 71, '00:00:15', '', 'active'),
(1825, 13, 17, '1528620224', '1528620232', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:07', '', 'active'),
(1826, 13, 17, '1528620232', '1528620248', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '00:00:11', '', 'deleted'),
(1827, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528620241, 1528620246, 1826, '', 0, '', '', ''),
(1828, 13, 17, '1528620254', '1528620268', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 71, '00:00:10', '', 'active'),
(1829, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528620262, 1528620266, 1828, '', 0, '', '', ''),
(1830, 13, 17, '1528620782', '1528620788', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:05', '', 'active'),
(1831, 13, 17, '1528620933', '1528620938', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:04', '', 'active'),
(1832, 13, 17, '1528620946', '1528620953', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:01', '', 'active'),
(1833, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528620947, 1528620953, 1832, '', 0, '', '', ''),
(1834, 13, 17, '1528620972', '1528620982', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 70, '00:00:09', '', 'active'),
(1835, 13, 17, '1528620960', '1528664340', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '12:03:00', '', 'deleted'),
(1836, 13, 17, '1528620997', '1528621016', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 71, '00:00:10', '', 'active'),
(1837, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528621004, 1528621012, 1836, '', 0, '', '', ''),
(1838, 13, 17, '1528621019', '1528621036', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 71, '00:00:14', '', 'active'),
(1839, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528621031, 1528621034, 1838, '', 0, '', '', ''),
(1840, 13, 17, '1528621758', '1528621765', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 71, '00:00:06', '', 'active'),
(1841, 13, 17, '1528674719', '1528674729', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 74, '00:00:09', '', 'active'),
(1842, 13, 17, '1528674730', '1528674731', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:01', '', 'active'),
(1843, 13, 17, '1528674733', '1528674742', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:03', '', 'active'),
(1844, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528674734, 1528674737, 1843, '', 0, '', '', ''),
(1845, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528674739, 1528674742, 1843, '', 0, '', '', ''),
(1846, 13, 17, '1528674745', '1528674748', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:02', '', 'active'),
(1847, 13, 17, '1528674762', '1528674764', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:02', '', 'active'),
(1848, 13, 17, '1528674989', '1528675018', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:25', '', 'active'),
(1849, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528675011, 1528675015, 1848, '', 0, '', '', ''),
(1850, 13, 17, '1528675127', '1528675137', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 70, '00:00:09', '', 'active'),
(1851, 13, 17, '1528675137', '1528675325', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 69, '00:03:08', '', 'deleted'),
(1852, 13, 17, '1528675330', '1528675357', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:26', '', 'active'),
(1853, 13, 17, '1528675357', '1528675362', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 69, '00:00:05', '', 'deleted'),
(1854, 13, 17, '1528675363', '1528675397', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 70, '00:00:03', '', 'active'),
(1855, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1528675366, 1528675397, 1854, '', 0, '', '', ''),
(1856, 13, 17, '', '1527854700', 0, '2018-06-01', '0.00000', 'yes', 0, 0, 0, '', 69, '424404:05:00', 'none', 'deleted'),
(1857, 13, 17, '1528675502', '1528675541', 0, '2018-06-11', '0.00000', 'yes', 0, 0, 0, '', 72, '00:00:39', '', 'active'),
(1858, 23, 17, '1528617600', '1528632000', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'deleted'),
(1859, 23, 17, '', '1531310400', 0, '2018-07-11', '0.00000', 'yes', 0, 0, 0, '', 69, '425364:00:00', '', 'deleted'),
(1860, 23, 17, '1528877040', '1528891200', 0, '2018-06-13', '0.00000', 'yes', 0, 0, 0, '', 69, '03:56:00', '', 'deleted'),
(1861, 23, 17, '1532649780', '1532692800', 0, '2018-07-27', '0.00000', 'yes', 0, 0, 0, '', 69, '11:57:00', '', 'deleted'),
(1862, 23, 17, '1525910580', '', 0, '2018-05-10', '0.00000', 'yes', 0, 0, 0, '', 69, '0-423865:57:00', '', 'deleted'),
(1863, 23, 17, '1529020980', '1529064000', 0, '2018-06-15', '0.00000', 'yes', 0, 0, 0, '', 69, '11:57:00', '', 'deleted'),
(1864, 23, 17, '1528588980', '1528632120', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '11:59:00', '', 'deleted'),
(1865, 13, 17, '', '1528632000', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '424620:00:00', '', 'deleted'),
(1866, 13, 17, '', '1528632000', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '424620:00:00', '', 'deleted'),
(1867, 13, 17, '', '1528632000', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '424620:00:00', '', 'deleted'),
(1868, 13, 17, '', '1528632000', 0, '2018-06-10', '0.00000', 'yes', 0, 0, 0, '', 69, '424620:00:00', '', 'deleted');

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
(18, 'Aubrey', 'Yates', 'aub@hotmail.com', 'aubrey', '$2y$10$BHy3mCllsrqo/XSAicC8IO/ghcy7MWUXQuukwU2T9PDZNYHdvcCwC', '', 0, 'Nothsor', 17),
(19, 'Jake', 'Milder', 'test@gmail.com', 'jmilder', '$2y$10$YIdaGNPaLPWtc2UauAmr/.ce4Qj0qRbVaJfhL1gCmje./HNEysD6y', '', 0, 'jmilder coop', 0),
(20, 'Jake', 'Milder', 'milder@gmail.com', 'New User', '$2y$10$jyDmnZMeUtVnv8n3m8/JceR0Jo9.wDzb9rPtwpirLzoD3ifbHIrzy', '', 0, '<i>Jork</i>', 0),
(21, 'Gore', 'Fore', 'afi@hotmail.com', 'gorefore', '$2y$10$qih4pbd5oDvYFo/F12tDseWySOS2/Qad4pha5YcYkLtjMGA09LPvi', '', 0, '', 17),
(22, 'Je', 'On', 'jeon@oh.com', 'dsiiw', '$2y$10$DnSDPIdLz9.EAcpZ8pi4ZuaJTlApj1sS47GrjENxUCV3cITUaK1fK', '', 0, '', 17),
(23, 'Cosmos', 'Lional', 'cs@hotmail.com', 'fuqboi', '$2y$10$Q7ATUb7Ucbc4kVnxEuzUeeWB4kHoqPG248kdZBmQvq/iijLFkH5ZO', '', 0, 'tinderpluscompany', 21),
(24, 'goog', 'lle', 'asd@htma.com', 'gllit', '$2y$10$mhpZVeyvXetbKRB7RxfSnenLlFt2.Ddc7j14RhCLzJvFDOAZMogUC', '', 0, 'coie', 0),
(25, 'asda', 'sds', 'asiojwi@ho.com', 'akjs', '$2y$10$VXYqyRMjum15mBwOznM3meu0DDWEDkpi6AtY482Cb6TSpiodP385G', '', 0, 'gera', 0),
(26, 'asd', 'asdaa', 'ask@hoam.com', 'kja', '$2y$10$LLxuW0a2rwCpTVnDKQNtzOtr1BPyMP5JIDsfkQ19QVIxznEe1AuC2', '', 0, '', 26),
(27, 'asda', 'asdw', 'asd@jo.com', 'jkah', '$2y$10$QmMj.GnmolEGF/OyO0.F4ubWvXMW/GCwdlRSarOvt.9rOG4c9OeEy', '', 0, '', 27),
(28, 'asda', 'asdw', 'asd@jo.com', 'sdfsfd', '$2y$10$nKiQNRk.EOEsGDh76h7/POGL.6Kh9hUSNQoIfvlCEYE12hwQapj2q', '', 0, '', 28),
(29, 'asda', 'asdw', 'asd@jo.com', 'sdsaa', '$2y$10$bIzmKgwmnhlBPHx4tGme2umX7vgIoQIvITQb1r3sqRnYsImM.Jghi', '', 0, '', 29),
(30, 'zfd', 'ads', 'as22@joijo.com', 'foo', '$2y$10$95AOH3o/3cEfXaVMY40pm.7LKoy0.9w8llP3wZlCqDuconieuuE9y', '', 0, '', 30),
(31, 'dfdsds', 'sdfdsdf', 'sdf@hotmail.com', 'ak', '$2y$10$E5ILaaIaqsAu59ijuIC.eeJYb3ODy70BBwIOm4wCsxfPTZ2JE9cDa', '', 0, '', 31),
(32, 'Kit', 'Kat', 'kitkat@kit.com', 'life_ruler', '$2y$10$ULOVnCDypomunz3FXwxho.iX5sV56xLBQ..E7vLoUlZkPJH88OyZC', '', 0, '', 32);

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
-- Indexes for table `company_events`
--
ALTER TABLE `company_events`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `assignment_managers`
--
ALTER TABLE `assignment_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `company_events`
--
ALTER TABLE `company_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_info_and_settings`
--
ALTER TABLE `company_info_and_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `timeGeneral`
--
ALTER TABLE `timeGeneral`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1869;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;