-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 10:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmisphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `classId` varchar(20) NOT NULL,
  `classArmId` varchar(20) NOT NULL,
  `course_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `classId`, `classArmId`, `course_code`) VALUES
(7, 'mathimathics', '2', '2', '003'),
(8, 'Biology', '1', '2', '001'),
(9, 'chemistry', '1', '2', '002'),
(10, 'Physics', '1', '2', '004');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_type` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `classId` varchar(20) NOT NULL,
  `session_id` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `term` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_type`, `course_id`, `classId`, `session_id`, `created_date`, `term`) VALUES
(9, 'Mid Exam', '8', '1', '5', '2023-07-13 20:58:17', '1'),
(10, 'Mid Exam', '9', '1', '5', '2023-07-13 20:58:38', '1');

-- --------------------------------------------------------

--
-- Table structure for table `his_accounts`
--

CREATE TABLE `his_accounts` (
  `acc_id` int(200) NOT NULL,
  `acc_name` varchar(200) DEFAULT NULL,
  `acc_desc` text,
  `acc_type` varchar(200) DEFAULT NULL,
  `acc_number` varchar(200) DEFAULT NULL,
  `acc_amount` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `his_accounts`
--

INSERT INTO `his_accounts` (`acc_id`, `acc_name`, `acc_desc`, `acc_type`, `acc_number`, `acc_amount`) VALUES
(1, 'Individual Retirement Account', '<p>IRA&rsquo;s are simply an account where you stash your money for retirement. The concept is pretty simple, your account balance is not taxed UNTIL you withdraw, at which point you pay the taxes there. This allows you to grow your account with interest without taxes taking away from the balance. The net result is you earn more money.</p>', 'Payable Account', '518703294', '25000'),
(2, 'Equity Bank', '<p>Find <em>bank account</em> stock <em>images</em> in HD and millions of other royalty-free stock photos, illustrations and vectors in the Shutterstock collection. Thousands of new</p>', 'Receivable Account', '753680912', '12566'),
(3, 'Test Account Name', '<p>This is a demo test</p>', 'Payable Account', '620157843', '1100');

-- --------------------------------------------------------

--
-- Table structure for table `his_admin`
--

CREATE TABLE `his_admin` (
  `ad_id` int(20) NOT NULL,
  `ad_fname` varchar(200) DEFAULT NULL,
  `ad_lname` varchar(200) DEFAULT NULL,
  `ad_email` varchar(200) DEFAULT NULL,
  `ad_pwd` varchar(200) DEFAULT NULL,
  `ad_dpic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `his_admin`
--

INSERT INTO `his_admin` (`ad_id`, `ad_fname`, `ad_lname`, `ad_email`, `ad_pwd`, `ad_dpic`) VALUES
(1, 'System', 'Administrator', 'admin@mail.com', '4c7f5919e957f354d57243d37f223cf31e9e7181', 'doc-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `his_payrolls`
--

CREATE TABLE `his_payrolls` (
  `pay_id` int(20) NOT NULL,
  `pay_number` varchar(200) DEFAULT NULL,
  `pay_doc_name` varchar(200) DEFAULT NULL,
  `pay_doc_number` varchar(200) DEFAULT NULL,
  `pay_doc_email` varchar(200) DEFAULT NULL,
  `pay_emp_salary` varchar(200) DEFAULT NULL,
  `pay_date_generated` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4),
  `pay_status` varchar(200) DEFAULT NULL,
  `pay_descr` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `his_payrolls`
--

INSERT INTO `his_payrolls` (`pay_id`, `pay_number`, `pay_doc_name`, `pay_doc_number`, `pay_doc_email`, `pay_emp_salary`, `pay_date_generated`, `pay_status`, `pay_descr`) VALUES
(5, '6G9WE', 'MELKAMU MENGAW', 'YDS7L', 'MELKAMUMENGAW@gmail.com', '12000', '2023-07-14 11:18:04.3101', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `his_staf`
--

CREATE TABLE `his_staf` (
  `staf_id` int(20) NOT NULL,
  `staf_fname` varchar(200) DEFAULT NULL,
  `staf_lname` varchar(200) DEFAULT NULL,
  `staf_email` varchar(200) DEFAULT NULL,
  `staf_pwd` varchar(200) DEFAULT NULL,
  `staf_dept` varchar(200) DEFAULT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `staf_number` varchar(200) DEFAULT NULL,
  `staf_dpic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `his_staf`
--

INSERT INTO `his_staf` (`staf_id`, `staf_fname`, `staf_lname`, `staf_email`, `staf_pwd`, `staf_dept`, `classId`, `classArmId`, `staf_number`, `staf_dpic`) VALUES
(5, 'Aletha', 'White', 'aletha@mail.com', 'dce0b27ba675df41e9cc07af80ec59c475810824', 'Laboratory', '1', '2', 'BKTWQ', 'defaultimg.jpg'),
(6, 'MELKAMU', 'MENGAW', 'MELKAMUMENGAW@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', 'chemistry', '1', '2', 'YDS7L', 'user-default-2-min.png'),
(12, 'fatuma', 'kebede', 'jessica@mail.com', 'dce0b27ba675df41e9cc07af80ec59c475810824', 'Mathimatics', '1', '4', '5VIFT', 'usric.png');

-- --------------------------------------------------------

--
-- Table structure for table `his_students`
--

CREATE TABLE `his_students` (
  `pat_id` int(20) NOT NULL,
  `pat_fname` varchar(200) DEFAULT NULL,
  `pat_lname` varchar(200) DEFAULT NULL,
  `pat_dob` varchar(200) DEFAULT NULL,
  `pat_age` varchar(200) DEFAULT NULL,
  `admissionNumber` varchar(200) DEFAULT NULL,
  `stu_pwd` varchar(200) NOT NULL,
  `pat_addr` varchar(200) DEFAULT NULL,
  `pat_phone` varchar(200) DEFAULT NULL,
  `classId` varchar(10) DEFAULT NULL,
  `classArmId` varchar(10) DEFAULT NULL,
  `s_gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `his_students`
--

INSERT INTO `his_students` (`pat_id`, `pat_fname`, `pat_lname`, `pat_dob`, `pat_age`, `admissionNumber`, `stu_pwd`, `pat_addr`, `pat_phone`, `classId`, `classArmId`, `s_gender`) VALUES
(8, 'Michael', 'White', '02/02/1992', '18', 'DCRI8', '12345678', '60 Radford Street', '1458887854', '1', '2', 'Male'),
(12, 'MELKAMU', 'MENGAW', '2023-06-29', '16', 'EYL1R', '12345678', 'college', '0912345678', '1', '2', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `towhom` varchar(20) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `discription` longtext NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `towhom`, `title`, `discription`, `created_date`) VALUES
(3, 'Student', 'Registration Notice', 'Dear Students, Admission process has been started for this academic year at main office . Confirm your admission before it too late. \r\n\r\nRegards,\r\nThe School', '07-14-2023'),
(4, 'Staf', 'Meeting Notice', 'Dear Teachers,\r\n\r\nThis is to inform you that there will be a meeting on Monday, July 17, at 3:00 pm in the staff room. The agenda of the meeting is to discuss the following topics:\r\n\r\n- Review of the academic performance of the students in the first term\r\n- Planning of the co-curricular activities and events for the second term\r\n- Allocation of duties and responsibilities for the upcoming parent-teacher conference\r\n- Any other issues or concerns raised by the teachers\r\n\r\nYour attendance and participation in the meeting is mandatory and highly appreciated. Please confirm your availability by replying to this email by Saturday, July 15.\r\n\r\nThank you for your cooperation and dedication.\r\n\r\nSincerely,\r\nPrincipal\r\n', '07-14-2023');

-- --------------------------------------------------------

--
-- Table structure for table `sresult`
--

CREATE TABLE `sresult` (
  `result_id` int(11) NOT NULL,
  `pat_id` varchar(50) DEFAULT NULL,
  `class_name` varchar(20) NOT NULL,
  `course_id` varchar(50) DEFAULT NULL,
  `midresult` varchar(50) DEFAULT NULL,
  `finalresult` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sresult`
--

INSERT INTO `sresult` (`result_id`, `pat_id`, `class_name`, `course_id`, `midresult`, `finalresult`) VALUES
(34, '9', 'nine', '9', '45', '45'),
(35, '8', 'nine', '9', '34', '56');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `Id` int(10) NOT NULL,
  `admissionNo` varchar(255) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dateTimeTaken` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`Id`, `admissionNo`, `classId`, `classArmId`, `status`, `dateTimeTaken`) VALUES
(16, 'DCRI8', '1', '2', '1', '2023-07-13'),
(17, 'EYL1R', '1', '2', '0', '2023-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `Id` int(10) NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`Id`, `className`) VALUES
(1, 'nine'),
(2, 'Ten');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassarms`
--

CREATE TABLE `tblclassarms` (
  `Id` int(10) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmName` varchar(255) NOT NULL,
  `isAssigned` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclassarms`
--

INSERT INTO `tblclassarms` (`Id`, `classId`, `classArmName`, `isAssigned`) VALUES
(2, '1', 'S1', '1'),
(5, '3', 'E1', '1'),
(6, '4', 'N1', '1'),
(7, '3', 'qq', '0'),
(8, '4', 'nn', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblsessionterm`
--

CREATE TABLE `tblsessionterm` (
  `Id` int(10) NOT NULL,
  `sessionName` varchar(50) NOT NULL,
  `termId` varchar(50) NOT NULL,
  `isActive` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsessionterm`
--

INSERT INTO `tblsessionterm` (`Id`, `sessionName`, `termId`, `isActive`, `dateCreated`) VALUES
(5, '1', '1', '1', '2023-07-13'),
(3, '2', '2', '0', '2022-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `tblterm`
--

CREATE TABLE `tblterm` (
  `Id` int(10) NOT NULL,
  `termName` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblterm`
--

INSERT INTO `tblterm` (`Id`, `termName`) VALUES
(1, 'First'),
(2, 'Second'),
(3, 'Third');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `his_accounts`
--
ALTER TABLE `his_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `his_admin`
--
ALTER TABLE `his_admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `his_payrolls`
--
ALTER TABLE `his_payrolls`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `his_staf`
--
ALTER TABLE `his_staf`
  ADD PRIMARY KEY (`staf_id`);

--
-- Indexes for table `his_students`
--
ALTER TABLE `his_students`
  ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `sresult`
--
ALTER TABLE `sresult`
  ADD PRIMARY KEY (`result_id`),
  ADD UNIQUE KEY `uc` (`pat_id`,`course_id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UC_tblattendance_admissionNo_dateTimeTaken` (`admissionNo`,`dateTimeTaken`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclassarms`
--
ALTER TABLE `tblclassarms`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblsessionterm`
--
ALTER TABLE `tblsessionterm`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblterm`
--
ALTER TABLE `tblterm`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `his_accounts`
--
ALTER TABLE `his_accounts`
  MODIFY `acc_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `his_admin`
--
ALTER TABLE `his_admin`
  MODIFY `ad_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `his_payrolls`
--
ALTER TABLE `his_payrolls`
  MODIFY `pay_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `his_staf`
--
ALTER TABLE `his_staf`
  MODIFY `staf_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `his_students`
--
ALTER TABLE `his_students`
  MODIFY `pat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sresult`
--
ALTER TABLE `sresult`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblclassarms`
--
ALTER TABLE `tblclassarms`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsessionterm`
--
ALTER TABLE `tblsessionterm`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblterm`
--
ALTER TABLE `tblterm`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
